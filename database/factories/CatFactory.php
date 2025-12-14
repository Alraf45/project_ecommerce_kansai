<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cat>
 */
class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'Nama Produk' => $this->faker->unique()->word(),
            'Kategori' => $this->faker->word(),
            'Stok' => $this->faker->numberBetween(0, 100),
            'Harga' => $this->faker->randomFloat(2, 1000, 1000000),
            'Gambar' => $this->faker->imageUrl(640, 480),                                                
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
