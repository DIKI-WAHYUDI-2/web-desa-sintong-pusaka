<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    public function definition(): array
    {
        $judul = fake()->unique()->sentence(6);

        return [
            'judul' => $judul,
            'isi' => fake()->paragraphs(3, true),
            'gambar' => null,
            'gambar2' => null,
            'gambar3' => null,
            'tanggal' => fake()->date(),
            'kategori' => fake()->randomElement(['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan']),
            'organisasi' => fake()->randomElement(['Kepenghuluan', 'Karang Taruna', 'PKK']),
            'slug' => Str::slug($judul) . '-' . fake()->unique()->numberBetween(1, 100000),
        ];
    }
}
