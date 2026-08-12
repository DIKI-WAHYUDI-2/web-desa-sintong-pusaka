<?php

namespace Tests\Unit;

use App\Models\Berita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeritaModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_bisa_membuat_berita_lewat_mass_assignment(): void
    {
        $berita = Berita::create([
            'judul' => 'Judul Uji Coba',
            'isi' => 'Isi berita.',
            'tanggal' => '2026-01-01',
            'kategori' => 'Sosial',
            'organisasi' => 'Kepenghuluan',
            'slug' => 'judul-uji-coba',
        ]);

        $this->assertDatabaseHas('berita', ['id' => $berita->id, 'judul' => 'Judul Uji Coba']);
    }

    public function test_menggunakan_tabel_berita(): void
    {
        $this->assertSame('berita', (new Berita())->getTable());
    }
}
