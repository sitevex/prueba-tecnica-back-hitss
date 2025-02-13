<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar registros existentes
        // Departamento::truncate();

        // Crear registro de cargos
        Departamento::insert([
            ['codigo' => 'DEP001', 'nombre' => 'Recursos Humanos', 'activo' => true],
            ['codigo' => 'DEP002', 'nombre' => 'Tecnología', 'activo' => true],
            ['codigo' => 'DEP003', 'nombre' => 'Ventas', 'activo' => true],
            ['codigo' => 'DEP004', 'nombre' => 'Administración', 'activo' => true],
            ['codigo' => 'DEP005', 'nombre' => 'Bodega', 'activo' => true],
        ]);
    }
}
