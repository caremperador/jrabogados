<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListaRequisito>
 */
class ListaRequisitoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Relación con User
            'nombre' => 'lista requisito ' . fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
