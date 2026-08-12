<?php

namespace Tests\Feature;

use App\Models\Pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_menolak_yang_belum_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect(route('login'));
    }

    public function test_dashboard_bisa_diakses_setelah_login(): void
    {
        $pengguna = Pengguna::factory()->create();

        $response = $this->actingAs($pengguna)->get('/dashboard');

        $response->assertStatus(200);
    }
}
