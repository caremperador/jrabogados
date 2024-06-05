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
        Schema::create('caso_tarea', function (Blueprint $table) {
            $table->unsignedBigInteger('caso_id');
            $table->unsignedBigInteger('tarea_id');
            $table->timestamps();

            $table->primary(['caso_id', 'tarea_id']);
            $table->foreign('caso_id')->references('id')->on('casos')->onDelete('cascade');
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caso_tarea');
    }
};
