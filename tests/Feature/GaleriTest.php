<?php

namespace Tests\Feature;

use App\Models\Galeri;
use App\Models\Pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GaleriTest extends TestCase
{
    use RefreshDatabase;

    private function login(): Pengguna
    {
        $pengguna = Pengguna::factory()->create();
        $this->actingAs($pengguna);
        return $pengguna;
    }

    public function test_route_galeri_menolak_yang_belum_login(): void
    {
        $this->get('/galeri')->assertRedirect(route('login'));
        $this->get('/galeri/create')->assertRedirect(route('login'));
    }

    public function test_index_menampilkan_daftar_galeri(): void
    {
        $this->login();
        Galeri::factory()->create(['judul' => 'Album Peringatan 17 Agustus']);

        $response = $this->get('/galeri');

        $response->assertStatus(200);
        $response->assertSee('Album Peringatan 17 Agustus');
    }

    public function test_bisa_membuat_galeri_dengan_foto(): void
    {
        Storage::fake('public');
        $this->login();

        $response = $this->post('/galeri', [
            'judul' => 'Album Gotong Royong',
            'kategori' => 'Sosial',
            'organisasi' => 'Karang Taruna',
            'gambar' => [
                UploadedFile::fake()->image('foto1.jpg'),
                UploadedFile::fake()->image('foto2.jpg'),
            ],
        ]);

        $response->assertRedirect(route('galeri'));
        $this->assertDatabaseHas('galeri', ['judul' => 'Album Gotong Royong']);
        $galeri = Galeri::where('judul', 'Album Gotong Royong')->first();
        $this->assertCount(2, $galeri->fotos);
    }

    public function test_membuat_galeri_gagal_tanpa_judul(): void
    {
        $this->login();

        $response = $this->post('/galeri', [
            'kategori' => 'Sosial',
        ]);

        $response->assertSessionHasErrors(['judul']);
    }

    public function test_bisa_hapus_galeri_beserta_fotonya(): void
    {
        Storage::fake('public');
        $this->login();
        $galeri = Galeri::factory()->create();
        $galeri->fotos()->create(['gambar' => 'galeri_images/contoh.jpg']);

        $response = $this->delete("/galeri/{$galeri->id}");

        $response->assertRedirect(route('galeri'));
        $this->assertDatabaseMissing('galeri', ['id' => $galeri->id]);
        $this->assertDatabaseMissing('galeri_fotos', ['galeri_id' => $galeri->id]);
    }
}
