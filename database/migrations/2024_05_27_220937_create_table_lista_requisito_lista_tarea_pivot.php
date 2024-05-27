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
        Schema::create('lista_requisito_lista_tarea', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lista_tarea_id');
            $table->unsignedBigInteger('lista_requisito_id');

            $table->index([
                'lista_tarea_id',
                'lista_requisito_id',
            ],  'idx_tarea_requisito');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_requisito_lista_tarea');
    }
};
