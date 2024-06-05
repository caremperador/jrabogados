<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tarea;
use App\Models\Requisito;
use App\Models\Caso;
use App\Models\ListaRequisito;
use App\Models\Estado;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 3 usuarios
        $users = User::factory(3)->create();

        // Crear estados iniciales
        $estados = ['no_iniciada', 'en_proceso', 'completada'];
        foreach ($estados as $estado) {
            Estado::create(['estado' => $estado]);
        }

        // Crear 2 listas de requisitos para cada usuario
        $users->each(function ($user) {
            ListaRequisito::factory(2)->create(['user_id' => $user->id]);
        });

        // Crear 2 casos para cada usuario
        $users->each(function ($user) {
            Caso::factory(2)->create(['user_id' => $user->id]);
        });

        // Crear 5 tareas y asociarlas a cada caso y establecer estado inicial
        Caso::all()->each(function ($caso) {
            $tareas = Tarea::factory(5)->create();

            // Asociar tareas al caso y establecer estado inicial
            $estadoNoIniciada = Estado::where('estado', 'no_iniciada')->first();
            foreach ($tareas as $tarea) {
                $caso->tareas()->attach($tarea->id);
                $tarea->estados()->attach($estadoNoIniciada->id);
            }

            // Crear listas de requisitos y asociarlas al caso
            $listasRequisitos = ListaRequisito::factory(mt_rand(1, 10))
                ->create(['user_id' => $caso->user_id]);
            $caso->listasRequisitos()->attach($listasRequisitos);
        });

        // Crear 5 requisitos para cada lista de requisitos
        ListaRequisito::all()->each(function ($listaRequisito) {
            Requisito::factory(5)->create(['lista_requisitos_id' => $listaRequisito->id]);
        });

        // Llamar a otros seeders si es necesario
        $this->call(RoleAssignSeeder::class);
    }
}
