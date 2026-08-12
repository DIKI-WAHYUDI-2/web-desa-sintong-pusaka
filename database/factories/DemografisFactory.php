<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Demografis>
 */
class DemografisFactory extends Factory
{
    public function definition(): array
    {
        return [
            'jumlah_dusun' => fake()->numberBetween(1, 10),
            'jumlah_rw' => fake()->numberBetween(1, 20),
            'jumlah_rt' => fake()->numberBetween(1, 40),
            'jumlah_keluarga' => fake()->numberBetween(100, 2000),
            'jumlah_penduduk' => fake()->numberBetween(500, 8000),
            'kepadatan_penduduk' => fake()->randomFloat(2, 10, 500),
            'jumlah_laki_laki' => fake()->numberBetween(250, 4000),
            'jumlah_perempuan' => fake()->numberBetween(250, 4000),
            'luas_perkebunan_sawit' => fake()->randomFloat(2, 10, 1000),
        ];
    }
}
