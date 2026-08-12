<?php

namespace Tests\Unit;

use App\Models\Pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PenggunaModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_tersimpan_dalam_bentuk_hash(): void
    {
        $pengguna = Pengguna::factory()->create(['password' => Hash::make('rahasia123')]);

        $this->assertTrue(Hash::check('rahasia123', $pengguna->password));
    }

    public function test_menggunakan_tabel_pengguna(): void
    {
        $this->assertSame('pengguna', (new Pengguna())->getTable());
    }
}
