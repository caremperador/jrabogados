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
        Schema::create('requisitos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lista_requisitos_id');
            $table->string('titulo')->fulltext();
            $table->text('descripcion')->nullable();
            $table->string('tipo_documento', 20)->default('pdf'); // Valores: pdf, foto, audio, otro
            $table->string('estado', 20)->default('no_subido'); // Valores: no_subido, revisando, rechazado, aprobado
            $table->text('razon_rechazo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitos');
    }
};
