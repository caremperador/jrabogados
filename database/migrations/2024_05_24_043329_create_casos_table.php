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
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre');
            $table->integer('progreso')->default(0);
            $table->timestamp('fecha_limite')->nullable();
            $table->string('estado_pago', 20)->default('sin_pagar');
            $table->decimal('adelanto', 10, 2)->default(0.00);
            $table->decimal('monto_total', 10, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casos');
    }
};
