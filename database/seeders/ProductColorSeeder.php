<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Color;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = Color::pluck('id');

        Product::all()->each(function ($product) use ($colors) {
            // random 3–5 warna per produk
            $randomColors = $colors->random(rand(3,5));
            $product->colors()->syncWithoutDetaching($randomColors);
        });
    }
}

