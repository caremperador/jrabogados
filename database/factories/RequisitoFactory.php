<?php

namespace Database\Factories;

use App\Models\ListaRequisito;
use App\Enums\TipoDocumentoEnum;
use App\Enums\EstadoRequisitoEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requisito>
 */
class RequisitoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lista_requisitos_id' => ListaRequisito::factory(), // Relación con ListaRequisito
            'titulo' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'tipo_documento' => $this->faker->randomElement(array_column(TipoDocumentoEnum::cases(), 'value')),
            'estado' => $this->faker->randomElement(array_column(EstadoRequisitoEnum::cases(), 'value')),
            'razon_rechazo' => $this->faker->optional()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
