<?php

namespace Tests\Feature;

use App\Models\Demografis;
use App\Models\Pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemografisTest extends TestCase
{
    use RefreshDatabase;

    private function login(): Pengguna
    {
        $pengguna = Pengguna::factory()->create();
        $this->actingAs($pengguna);
        return $pengguna;
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'jumlah_dusun' => 4,
            'jumlah_rw' => 8,
            'jumlah_rt' => 16,
            'jumlah_keluarga' => 500,
            'jumlah_penduduk' => 2000,
            'kepadatan_penduduk' => 120.5,
            'jumlah_laki_laki' => 1000,
            'jumlah_perempuan' => 1000,
            'luas_perkebunan_sawit' => 300.75,
        ], $overrides);
    }

    public function test_route_demografis_menolak_yang_belum_login(): void
    {
        $this->get('/demografis')->assertRedirect(route('login'));
    }

    public function test_bisa_membuat_data_demografis_baru_jika_belum_ada(): void
    {
        $this->login();

        $response = $this->post('/demografis/update', $this->validPayload());

        $response->assertRedirect(route('demografis'));
        $this->assertDatabaseHas('demografis', ['jumlah_dusun' => 4]);
    }

    public function test_bisa_update_data_demografis_yang_sudah_ada(): void
    {
        $this->login();
        $demografis = Demografis::factory()->create();

        $response = $this->post('/demografis/update', $this->validPayload(['jumlah_dusun' => 9]));

        $response->assertRedirect(route('demografis'));
        $this->assertDatabaseHas('demografis', ['id' => $demografis->id, 'jumlah_dusun' => 9]);
        $this->assertDatabaseCount('demografis', 1);
    }

    public function test_update_demografis_gagal_dengan_nilai_negatif(): void
    {
        $this->login();

        $response = $this->post('/demografis/update', $this->validPayload(['jumlah_penduduk' => -10]));

        $response->assertSessionHasErrors(['jumlah_penduduk']);
    }
}
