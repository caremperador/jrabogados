<?php

use App\Enums\EstadoTareaEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estado_tareas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lista_tarea_id');
            $table->unsignedBigInteger('tarea_id');
            $table->string('estado', 20)->default('no_iniciada');
            $table->timestamps();

            $table->foreign('lista_tarea_id')->references('id')->on('listas_tareas')->onDelete('cascade');
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_tareas');
    }
};
