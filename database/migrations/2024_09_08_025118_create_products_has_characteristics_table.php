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
        Schema::create('products_has_characteristics', function (Blueprint $table) {
            $table->foreignId('products_id')->constrained('products')->onDelete('restrict');
            $table->foreignId('characteristics_id')->constrained('characteristics')->onDelete('restrict');
            $table->string('value', 100)->nullable();
            $table->primary(['products_id', 'characteristics_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_has_characteristics');
    }
};
