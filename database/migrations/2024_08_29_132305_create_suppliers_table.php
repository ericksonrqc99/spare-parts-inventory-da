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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); // Longitud predeterminada
            $table->string('contact', 100); // Contacto del proveedor
            $table->string('country', 100)->nullable(); // País
            $table->string('state', 100)->nullable(); // Estado o región
            $table->string('city', 100)->nullable(); // Ciudad
            $table->string('address', 255)->nullable(); // Dirección, puede ser más específica
            $table->string('phone', 20); // Número de teléfono con prefijo internacional
            $table->string('email', 255)->nullable(); // Correo electrónico
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
