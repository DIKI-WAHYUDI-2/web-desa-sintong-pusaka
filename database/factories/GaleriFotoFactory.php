<?php

namespace Database\Factories;

use App\Models\Galeri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GaleriFoto>
 */
class GaleriFotoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'galeri_id' => Galeri::factory(),
            'gambar' => 'galeri_images/' . fake()->uuid() . '.jpg',
        ];
    }
}
