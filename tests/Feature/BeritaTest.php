<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeritaTest extends TestCase
{
    use RefreshDatabase;

    private function login(): Pengguna
    {
        $pengguna = Pengguna::factory()->create();
        $this->actingAs($pengguna);
        return $pengguna;
    }

    public function test_route_berita_menolak_yang_belum_login(): void
    {
        $this->get('/berita')->assertRedirect(route('login'));
        $this->get('/berita/create')->assertRedirect(route('login'));
        $this->post('/berita', [])->assertRedirect(route('login'));
    }

    public function test_index_menampilkan_daftar_berita(): void
    {
        $this->login();
        Berita::factory()->create(['judul' => 'Berita Panen Raya']);

        $response = $this->get('/berita');

        $response->assertStatus(200);
        $response->assertSee('Berita Panen Raya');
    }

    public function test_bisa_membuat_berita_baru(): void
    {
        $this->login();

        $response = $this->post('/berita', [
            'judul' => 'Pembangunan Jalan Desa',
            'isi' => 'Isi berita pembangunan jalan desa.',
            'tanggal' => '2026-01-10',
            'kategori' => 'Sosial',
            'organisasi' => 'Kepenghuluan',
        ]);

        $response->assertRedirect(route('berita'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('berita', [
            'judul' => 'Pembangunan Jalan Desa',
            'slug' => 'pembangunan-jalan-desa',
        ]);
    }

    public function test_membuat_berita_gagal_tanpa_judul(): void
    {
        $this->login();

        $response = $this->post('/berita', [
            'isi' => 'Isi berita.',
            'tanggal' => '2026-01-10',
            'kategori' => 'Sosial',
            'organisasi' => 'Kepenghuluan',
        ]);

        $response->assertSessionHasErrors(['judul']);
    }

    public function test_bisa_melihat_form_edit_berita(): void
    {
        $this->login();
        $berita = Berita::factory()->create();

        $response = $this->get("/berita/{$berita->id}/edit");

        $response->assertStatus(200);
        $response->assertSee($berita->judul);
    }

    public function test_bisa_update_berita(): void
    {
        $this->login();
        $berita = Berita::factory()->create();

        $response = $this->put("/berita/{$berita->id}", [
            'judul' => 'Judul Sudah Diperbarui',
            'isi' => $berita->isi,
            'tanggal' => $berita->tanggal,
            'kategori' => $berita->kategori,
            'organisasi' => $berita->organisasi,
        ]);

        $response->assertRedirect(route('berita'));
        $this->assertDatabaseHas('berita', [
            'id' => $berita->id,
            'judul' => 'Judul Sudah Diperbarui',
        ]);
    }

    public function test_bisa_hapus_berita(): void
    {
        $this->login();
        $berita = Berita::factory()->create();

        $response = $this->delete("/berita/{$berita->id}");

        $response->assertRedirect(route('berita'));
        $this->assertDatabaseMissing('berita', ['id' => $berita->id]);
    }

    public function test_hapus_berita_tidak_ada_menghasilkan_404(): void
    {
        $this->login();

        $response = $this->delete('/berita/99999');

        $response->assertStatus(404);
    }
}
