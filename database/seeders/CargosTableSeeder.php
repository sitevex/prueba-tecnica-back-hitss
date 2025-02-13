<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar registros existentes
        // Cargo::truncate();

        // Crear registro de cargos
        Cargo::insert([
            ['codigo' => 'CAR001', 'nombre' => 'Gerente de Recursos Humanos', 'activo' => true],
            ['codigo' => 'CAR002', 'nombre' => 'Desarrollador Senior', 'activo' => true],
            ['codigo' => 'CAR003', 'nombre' => 'Ejecutivo de Ventas', 'activo' => true],
            ['codigo' => 'CAR004', 'nombre' => 'Asistente de bodega', 'activo' => true],
            ['codigo' => 'CAR005', 'nombre' => 'Coordinadora administrativa', 'activo' => true],
        ]);
    }
}
