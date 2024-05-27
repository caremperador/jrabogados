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
        Schema::create('listas_tareas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre');
            $table->decimal('progreso')->default(0.00);
            $table->string('estado_pago', 20)->default('sin_pagar');
            $table->decimal('adelanto', 10, 2)->default(0.00);
            $table->decimal('monto_total', 10, 2)->default(0.00);
            $table->timestamps();

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_tareas');
    }
};
