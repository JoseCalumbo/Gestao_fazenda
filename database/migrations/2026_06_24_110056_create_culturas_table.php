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
        Schema::create('culturas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');          // ex: Milho, Soja, Café
            $table->string('variedade')->nullable(); // ex: Milho Híbrido, Café Arábica
            $table->integer('ciclo_dias')->nullable(); // Dias estimados da plantação à colheita
            $table->string('tipo_unidade')->default('KG'); // KG, Toneladas, Sacas (para a colheita)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culturas');
    }
};
