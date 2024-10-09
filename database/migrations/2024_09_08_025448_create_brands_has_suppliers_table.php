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
        Schema::create('brands_has_suppliers', function (Blueprint $table) {
            $table->foreignId('brands_id')->constrained('brands')->onDelete('restrict');
            $table->foreignId('suppliers_id')->constrained('suppliers')->onDelete('restrict');
            $table->primary(['brands_id', 'suppliers_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands_has_suppliers');
    }
};
