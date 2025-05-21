<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create products table using schema from https://fakestoreapi.com/products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('price');
            $table->text('description');
            $table->string('category');
            $table->string('image');
            $table->float('rating_rate')->nullable(); // There are no null values for now, but just to test more cases
            $table->integer('rating_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
