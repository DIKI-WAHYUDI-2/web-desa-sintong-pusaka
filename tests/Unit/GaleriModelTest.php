<?php

namespace Tests\Unit;

use App\Models\Galeri;
use App\Models\GaleriFoto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GaleriModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_galeri_punya_banyak_fotos(): void
    {
        $galeri = Galeri::factory()->create();
        GaleriFoto::factory()->count(3)->create(['galeri_id' => $galeri->id]);

        $this->assertCount(3, $galeri->fresh()->fotos);
    }

    public function test_foto_terhubung_ke_galeri_induknya(): void
    {
        $galeri = Galeri::factory()->create();
        $foto = GaleriFoto::factory()->create(['galeri_id' => $galeri->id]);

        $this->assertTrue($foto->galeri->is($galeri));
    }
}
