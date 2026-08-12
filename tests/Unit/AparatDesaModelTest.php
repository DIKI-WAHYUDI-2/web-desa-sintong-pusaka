<?php

namespace Tests\Unit;

use App\Models\AparatDesa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AparatDesaModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_aparat_tidak_menggunakan_timestamps(): void
    {
        $aparat = new AparatDesa();

        $this->assertFalse($aparat->timestamps);
    }

    public function test_bisa_membuat_aparat_lewat_mass_assignment(): void
    {
        $aparat = AparatDesa::create([
            'nama' => 'Contoh Nama',
            'jabatan' => 'Sekdes',
            'mulai_jabatan' => '2024-01-01',
            'status_aktif' => true,
        ]);

        $this->assertDatabaseHas('aparat_desa', ['id' => $aparat->id, 'nama' => 'Contoh Nama']);
    }
}
