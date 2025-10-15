<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                               // Nama produk
            $table->string('image')->nullable();                  // Gambar produk (path lokal)
            $table->decimal('price', 12, 2);                      // Harga
            $table->integer('stock')->default(0);                 // Stok
            $table->unsignedBigInteger('category_id');            // Relasi ke categories
            $table->unsignedBigInteger('color_id');               // Relasi ke colors
            $table->timestamps();

            // Foreign key
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->foreign('color_id')
                ->references('id')->on('colors')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
