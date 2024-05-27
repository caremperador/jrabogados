<?php

namespace Database\Factories;

use App\Enums\EstadoTareaEnum;
use App\Models\ListaTarea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lista_tareas_id' => ListaTarea::factory(), // Relación con ListaTarea
            'titulo' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'estado' => $this->faker->randomElement(EstadoTareaEnum::cases()),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
