<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductColor;

class ProductColorSeeder extends Seeder
{
    public function run(): void
    {
        // WARNA TETAP PER PRODUK (3–5)
        $data = [
            'KANSAI PEARLSHEEN' => ['#ed2024', '#3953a4', '#0b8140','#7c277d'],
            'KANSAI DIAMOND SHIELD' => ['#3953a4', '#faa41a', '#f6eb14','#ed2024'],
            'KANSAI SPLESH GLIMMER' => ['#faa41a', '#f6eb14', '#ed2024','#3953a4','#0b8140'],
            'KANSAI ANTIMOSQUITO' => ['#0b8140', '#ed2024', '#f6eb14','#7c277d','#3953a4'],
            'KANSAI TROPIC' => ['#3953a4', '#0b8140', '#faa41a','#f6eb14','#7c277d'],
            'KANSAI PROPERTY INTERIOR' => ['#faa41a', '#ed2024', '#3953a4','#7c277d'],
            'KANSAI PROPERTY EKSTERIOR' => ['#3953a4', '#964b00', '#0b8140','#ed2024'],
            'KANSAI SPLESH' => ['#ed2024', '#faa41a', '#3953a4'],
            'KANSAI RAIN BLOCK' => ['#3953a4', '#0b8140', '#faa41a'],
            'KANSAI FTALIT' => ['#b5ac96','#964b00'],
            'KANSAI FTALIT DUO' => ['#b5ac96','#964b00','#0b8140'],
        ];

        foreach ($data as $productName => $colors) {

            $product = Product::where('name', $productName)->first();

            if (!$product) {
                continue;
            }

            // kalau sudah ada warna, skip (aman)
            if ($product->colors()->count() > 0) {
                continue;
            }

            foreach ($colors as $warna) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'warna' => $warna,
                ]);
            }
        }
    }
}
