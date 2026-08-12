<?php

namespace Tests\Feature;

use App\Models\AparatDesa;
use App\Models\Pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AparatDesaTest extends TestCase
{
    use RefreshDatabase;

    private function login(): Pengguna
    {
        $pengguna = Pengguna::factory()->create();
        $this->actingAs($pengguna);
        return $pengguna;
    }

    public function test_route_aparat_menolak_yang_belum_login(): void
    {
        $this->get('/aparat')->assertRedirect(route('login'));
    }

    public function test_index_menampilkan_daftar_aparat(): void
    {
        $this->login();
        AparatDesa::factory()->create(['nama' => 'Siti Aminah']);

        $response = $this->get('/aparat');

        $response->assertStatus(200);
        $response->assertSee('Siti Aminah');
    }

    public function test_bisa_membuat_aparat_baru(): void
    {
        $this->login();

        $response = $this->post('/aparat', [
            'nama' => 'Andi Wijaya',
            'jabatan' => 'Kaur Umum',
            'mulai_jabatan' => '2024-01-01',
            'status_aktif' => 1,
        ]);

        $response->assertRedirect(route('aparat_desa.index'));
        $this->assertDatabaseHas('aparat_desa', ['nama' => 'Andi Wijaya']);
    }

    public function test_membuat_aparat_gagal_tanpa_nama(): void
    {
        $this->login();

        $response = $this->post('/aparat', [
            'jabatan' => 'Kaur Umum',
            'mulai_jabatan' => '2024-01-01',
            'status_aktif' => 1,
        ]);

        $response->assertSessionHasErrors(['nama']);
    }

    public function test_akhir_jabatan_harus_setelah_mulai_jabatan(): void
    {
        $this->login();

        $response = $this->post('/aparat', [
            'nama' => 'Andi Wijaya',
            'jabatan' => 'Kaur Umum',
            'mulai_jabatan' => '2024-01-01',
            'akhir_jabatan' => '2023-01-01',
            'status_aktif' => 1,
        ]);

        $response->assertSessionHasErrors(['akhir_jabatan']);
    }

    public function test_bisa_update_aparat_sebagian_field(): void
    {
        $this->login();
        $aparat = AparatDesa::factory()->create(['jabatan' => 'Kaur Umum']);

        $response = $this->put("/aparat/{$aparat->id}", [
            'jabatan' => 'Sekdes',
        ]);

        $response->assertRedirect(route('aparat_desa.index'));
        $this->assertDatabaseHas('aparat_desa', ['id' => $aparat->id, 'jabatan' => 'Sekdes']);
    }

    public function test_bisa_hapus_aparat(): void
    {
        $this->login();
        $aparat = AparatDesa::factory()->create();

        $response = $this->delete("/aparat/{$aparat->id}");

        $response->assertRedirect(route('aparat_desa.index'));
        $this->assertDatabaseMissing('aparat_desa', ['id' => $aparat->id]);
    }
}
