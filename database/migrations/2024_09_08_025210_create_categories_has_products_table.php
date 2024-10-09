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
        Schema::create('categories_has_products', function (Blueprint $table) {
            $table->foreignId('categories_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('products_id')->constrained('products')->onDelete('restrict');
            $table->primary(['categories_id', 'products_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_has_products');
    }
};
