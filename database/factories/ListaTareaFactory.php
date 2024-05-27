<?php

namespace Database\Factories;

use App\Enums\EstadoPagoEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListaTarea>
 */
class ListaTareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $monto_total = 100;
        return [
            'user_id' => User::factory(), // Relación con User
            'nombre' => 'lista tareas ' . fake()->sentence,
            'estado_pago' => fake()->randomElement(array_column(EstadoPagoEnum::cases(), 'value')),
            'adelanto' => mt_rand(10, $monto_total),
            'monto_total' => $monto_total,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
