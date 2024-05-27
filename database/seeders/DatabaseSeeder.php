<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Tarea;
use App\Models\Requisito;
use App\Models\ListaTarea;
use App\Models\ListaRequisito;
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

        // Crear 2 listas de requisitos para cada usuario
        $users->each(function ($user) {
            ListaRequisito::factory(2)->create(['user_id' => $user->id]);
        });

        // Crear 2 listas de tareas para cada usuario
        $users->each(function ($user) {
            ListaTarea::factory(2)->create(['user_id' => $user->id]);
        });

        // Crear 5 tareas para cada lista de tareas
        ListaTarea::all()->each(function ($listaTarea) {
            Tarea::factory(5)->create(['lista_tareas_id' => $listaTarea->id]);
        });

        // Crear 5 requisitos para cada lista de requisitos
        ListaRequisito::all()->each(function ($listaRequisito) {
            Requisito::factory(5)->create(['lista_requisitos_id' => $listaRequisito->id]);
        });
        $this->call(RoleAssignSeeder::class);
    }
}
