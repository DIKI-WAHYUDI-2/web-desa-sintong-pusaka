<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galeri>
 */
class GaleriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(4),
            'kategori' => fake()->randomElement(['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan']),
            'organisasi' => fake()->randomElement(['Kepenghuluan', 'Karang Taruna', 'PKK']),
        ];
    }
}
