<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_creation_models', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('category');
            $table->decimal('price', 10, 2);
            $table->string('image', 255);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('product_creation_models');
    }
};