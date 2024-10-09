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
        Schema::create('products_has_model_cars', function (Blueprint $table) {
            $table->foreignId('products_id')
                ->constrained('products')
                ->onDelete('restrict');

            $table->foreignId('model_cars_id')
                ->constrained('model_cars')
                ->onDelete('restrict');

            $table->primary(['products_id', 'model_cars_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_has_model_cars');
    }
};
