<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AparatDesa>
 */
class AparatDesaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'jabatan' => fake()->randomElement(['Pj. Penghulu', 'Sekdes', 'Kaur Keuangan', 'Kaur Umum']),
            'foto' => null,
            'mulai_jabatan' => fake()->date(),
            'akhir_jabatan' => null,
            'status_aktif' => true,
        ];
    }
}
