<?php

namespace Tests\Unit;

use App\Models\Demografis;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemografisModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_hanya_menyimpan_satu_baris_data_yang_dipakai(): void
    {
        Demografis::factory()->create();

        $this->assertNotNull(Demografis::first());
    }

    public function test_bisa_membuat_demografis_lewat_mass_assignment(): void
    {
        $demografis = Demografis::create([
            'jumlah_dusun' => 4,
            'jumlah_rw' => 8,
            'jumlah_rt' => 16,
            'jumlah_keluarga' => 500,
            'jumlah_penduduk' => 2000,
            'kepadatan_penduduk' => 120.5,
            'jumlah_laki_laki' => 1000,
            'jumlah_perempuan' => 1000,
            'luas_perkebunan_sawit' => 300.75,
        ]);

        $this->assertDatabaseHas('demografis', ['id' => $demografis->id, 'jumlah_dusun' => 4]);
    }
}
