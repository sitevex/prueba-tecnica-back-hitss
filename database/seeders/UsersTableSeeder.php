<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar registros existentes
        // User::truncate();

        // Crear registro de users
        Usuario::insert([
            [
                'usuario' => 'admin',
                'primerNombre' => 'Juan',
                'segundoNombre' => 'Carlos',
                'primerApellido' => 'Pérez',
                'segundoApellido' => 'Gómez',
                'idDepartamento' => 1,
                'idCargo' => 1,
                'email' => 'admin@hitss.com',
            ],
            [
                'usuario' => 'desarrollador',
                'primerNombre' => 'Ana',
                'segundoNombre' => 'María',
                'primerApellido' => 'López',
                'segundoApellido' => 'Martínez',
                'idDepartamento' => 2,
                'idCargo' => 2,
                'email' => 'desarrollador@hitss.com',
            ],
            [
                'usuario' => 'vendedor',
                'primerNombre' => 'Pedro',
                'segundoNombre' => 'Antonio',
                'primerApellido' => 'García',
                'segundoApellido' => 'Sánchez',
                'idDepartamento' => 3,
                'idCargo' => 3,
                'email' => 'vendedor@hitss.com',
            ]
        ]);
    }
}
