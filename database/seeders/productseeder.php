<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'KANSAI PEARLSHEEN', // id 1
                'price' => 295000,
                'stock' => 500,
                'category_id' => 3, // sesuaikan dengan id di tabel categories
                'color_id' => 7,    // sesuaikan dengan id di tabel colors
                'image' => 'img/products/pearlsheen.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI DIAMOND SHIELD', // id 2
                'price' => 402000,
                'stock' => 500,
                'category_id' => 3,
                'color_id' => 2,
                'image' => 'img/products/diamondshield.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI SPLESH GLIMMER', //id 3
                'price' => 350000,
                'stock' => 500,
                'category_id' => 3,
                'color_id' => 3,
                'image' => 'img/products/spleshglimmer.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI ANTIMOSQUITO', // id 4
                'price' => 220000,
                'stock' => 500,
                'category_id' => 1,
                'color_id' => 6,
                'image' => 'img/products/antimosquito.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI TROPIC', // id 5
                'price' => 125000,
                'stock' => 500,
                'category_id' => 1,
                'color_id' => 4,
                'image' => 'img/products/tropic.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI PROPERTY INTERIOR', // id 6
                'price' => 145000,
                'stock' => 500,
                'category_id' => 1,
                'color_id' => 5,
                'image' => 'img/products/propertyint.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI PROPERTY EKSTERIOR', // id 7
                'price' => 225000,
                'stock' => 500,
                'category_id' => 2,
                'color_id' => 3,
                'image' => 'img/products/propertyeks.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI SPLESH', // id 8
                'price' => 280000,
                'stock' => 500,
                'category_id' => 2,
                'color_id' => 2,
                'image' => 'img/products/splesh.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI RAIN BLOCK', // id 9
                'price' => 240000,
                'stock' => 500,
                'category_id' => 2,
                'color_id' => 6,
                'image' => 'img/products/rainblock.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KANSAI FTALIT', // id 10
                'price' => 95000,
                'stock' => 500,
                'category_id' => 4,
                'color_id' => 1,
                'image' => 'img/products/ftalit.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 
                'name' => 'KANSAI FTALIT DUO', // id 11
                'price' => 110000,
                'stock' => 500,
                'category_id' => 4,
                'color_id' => 1,
                'image' => 'img/products/ftalitduo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
