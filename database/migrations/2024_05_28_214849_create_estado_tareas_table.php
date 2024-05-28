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
            $table->string('estado', 20)->default(EstadoTareaEnum::NO_INICIADA);
            $table->timestamps();
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
