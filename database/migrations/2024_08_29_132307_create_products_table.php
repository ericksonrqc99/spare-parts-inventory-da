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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('sku', 100)->unique();
            $table->string('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->decimal('cost', 12, 2);
            $table->unsignedInteger('minimum_stock')->default(1);
            $table->unsignedInteger('stock')->default(0);
            $table->tinyInteger('alert_stock')->unsigned()->default(1);
            $table->tinyInteger('generic_use')->unsigned()->default(1);
            $table->foreignId('brands_id')->constrained('brands')->onDelete('restrict');
            $table->foreignId('suppliers_id')->constrained('suppliers')->onDelete('restrict');
            $table->foreignId('measurement_units_id')->constrained('measurement_units')->onDelete('restrict');
            $table->tinyInteger('status')->default(1);
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
