<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua id warna dari tabel colors
       

        $products = [
            [
                'name' => 'KANSAI PEARLSHEEN',
                'price' => 295000,
                'stock' => 500,
                'category_id' => 3,
                'image' => 'img/products/pearlsheen.png',
            ],
            [
                'name' => 'KANSAI DIAMOND SHIELD',
                'price' => 402000,
                'stock' => 500,
                'category_id' => 3,
                'image' => 'img/products/diamondshield.png',
            ],
            [
                'name' => 'KANSAI SPLESH GLIMMER',
                'price' => 350000,
                'stock' => 500,
                'category_id' => 3,
                'image' => 'img/products/spleshglimmer.png',
            ],
            [
                'name' => 'KANSAI ANTIMOSQUITO',
                'price' => 220000,
                'stock' => 500,
                'category_id' => 1,
                'image' => 'img/products/antimosquito.png',
            ],
            [
                'name' => 'KANSAI TROPIC',
                'price' => 125000,
                'stock' => 500,
                'category_id' => 1,
                'image' => 'img/products/tropic.png',
            ],
            [
                'name' => 'KANSAI PROPERTY INTERIOR',
                'price' => 145000,
                'stock' => 500,
                'category_id' => 1,
                'image' => 'img/products/propertyint.png',
            ],
            [
                'name' => 'KANSAI PROPERTY EKSTERIOR',
                'price' => 225000,
                'stock' => 500,
                'category_id' => 2,
                'image' => 'img/products/propertyeks.png',
            ],
            [
                'name' => 'KANSAI SPLESH',
                'price' => 280000,
                'stock' => 500,
                'category_id' => 2,
                'image' => 'img/products/splesh.png',
            ],
            [
                'name' => 'KANSAI RAIN BLOCK',
                'price' => 240000,
                'stock' => 500,
                'category_id' => 2,
                'image' => 'img/products/rainblock.png',
            ],
            [
                'name' => 'KANSAI FTALIT',
                'price' => 95000,
                'stock' => 500,
                'category_id' => 4,
                'image' => 'img/products/ftalit.png',
            ],
            [
                'name' => 'KANSAI FTALIT DUO',
                'price' => 110000,
                'stock' => 500,
                'category_id' => 4,
                'image' => 'img/products/ftalitduo.png',
            ],
        ];

        
    }
}
