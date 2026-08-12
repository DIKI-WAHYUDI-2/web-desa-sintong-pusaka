<?php

namespace Tests\Feature;

use App\Models\AparatDesa;
use App\Models\Berita;
use App\Models\Demografis;
use App\Models\Galeri;
use App\Models\GaleriFoto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_home_bisa_diakses(): void
    {
        Demografis::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_halaman_home_menampilkan_berita(): void
    {
        Demografis::factory()->create();
        $berita = Berita::factory()->create(['judul' => 'Musyawarah Desa Tahun Ini']);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Musyawarah Desa Tahun Ini');
    }

    public function test_halaman_home_bisa_filter_berita_per_organisasi(): void
    {
        Demografis::factory()->create();
        Berita::factory()->create(['organisasi' => 'Karang Taruna', 'judul' => 'Kegiatan Karang Taruna']);
        Berita::factory()->create(['organisasi' => 'PKK', 'judul' => 'Kegiatan PKK']);

        $response = $this->get('/?organisasi=Karang Taruna');

        $response->assertStatus(200);
        $response->assertSee('Kegiatan Karang Taruna');
    }

    public function test_halaman_home_menampilkan_data_aparat(): void
    {
        Demografis::factory()->create();
        AparatDesa::factory()->create(['nama' => 'Budi Santoso', 'jabatan' => 'Pj. Penghulu']);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
    }

    public function test_halaman_home_menampilkan_galeri_foto(): void
    {
        Demografis::factory()->create();
        $galeri = Galeri::factory()->create();
        GaleriFoto::factory()->create(['galeri_id' => $galeri->id]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_detail_berita_bisa_diakses_via_slug(): void
    {
        Demografis::factory()->create();
        $berita = Berita::factory()->create(['slug' => 'berita-uji-coba']);

        $response = $this->get('/berita/berita-uji-coba');

        $response->assertStatus(200);
        $response->assertSee($berita->judul);
    }

    public function test_detail_berita_404_untuk_slug_tidak_ada(): void
    {
        Demografis::factory()->create();

        $response = $this->get('/berita/slug-tidak-ada');

        $response->assertStatus(404);
    }
}
