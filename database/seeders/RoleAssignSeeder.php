<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $asistenteRole = Role::firstOrCreate(['name' => 'asistente']);

        $usuarios = [
            [
                'email' => 'admin@gmail.com',
                'name' => 'admin',
                'password' => bcrypt('123456'),
                'role' => $adminRole
            ],
            [
                'email' => 'asistente@gmail.com',
                'name' => 'asistente',
                'password' => bcrypt('123456'),
                'role' => $asistenteRole
            ],
        ];



        foreach ($usuarios as $usuario) {
            $user = User::firstOrCreate(
                ['email' => $usuario['email']],
                [
                    'name' => $usuario['name'],
                    'password' => $usuario['password']
                ]
            );

            if (!$user->hasRole($usuario['role']->name)) {
                $user->assignRole($usuario['role']);
            }
        }
    }
}
