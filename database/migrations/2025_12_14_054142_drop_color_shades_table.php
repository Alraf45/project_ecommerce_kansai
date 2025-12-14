<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('color_shades');
    }

    public function down(): void
    {
        Schema::create('color_shades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_id');
            $table->string('name');
            $table->string('hex');
            $table->timestamps();
            $table->foreign('color_id')->references('id')->on('colors')->cascadeOnDelete();
        });
    }
};
