<?php

namespace Tests\Feature;

use App\Models\Pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_form_bisa_diakses(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_yang_sudah_login_diarahkan_ke_dashboard_saat_buka_login(): void
    {
        $pengguna = Pengguna::factory()->create();

        $response = $this->actingAs($pengguna)->get('/login');

        $response->assertRedirect(route('dashboard'));
    }

    public function test_login_berhasil_dengan_kredensial_benar(): void
    {
        $pengguna = Pengguna::factory()->create([
            'email' => 'admin@desa.test',
            'password' => Hash::make('rahasia123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@desa.test',
            'password' => 'rahasia123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($pengguna);
    }

    public function test_login_gagal_dengan_password_salah(): void
    {
        Pengguna::factory()->create([
            'email' => 'admin@desa.test',
            'password' => Hash::make('rahasia123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@desa.test',
            'password' => 'password-salah',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error');
        $this->assertGuest();
    }

    public function test_login_gagal_dengan_email_tidak_terdaftar(): void
    {
        $response = $this->post('/login', [
            'email' => 'tidakada@desa.test',
            'password' => 'apapun123',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error');
        $this->assertGuest();
    }

    public function test_login_membutuhkan_email_dan_password(): void
    {
        $response = $this->post('/login', []);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_login_dibatasi_setelah_5_kali_gagal(): void
    {
        Pengguna::factory()->create([
            'email' => 'admin@desa.test',
            'password' => Hash::make('rahasia123'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', [
                'email' => 'admin@desa.test',
                'password' => 'salah',
            ]);
        }

        $response = $this->post('/login', [
            'email' => 'admin@desa.test',
            'password' => 'salah',
        ]);

        $response->assertSessionHas('error', function ($value) {
            return str_contains($value, 'Terlalu banyak percobaan');
        });
    }

    public function test_logout_berhasil(): void
    {
        $pengguna = Pengguna::factory()->create();

        $response = $this->actingAs($pengguna)->post('/logout');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
