<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Throwable;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Throwable
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('services')->insert([
                ['id' => 1, 'name' => 'Mantenimiento Preventivo', 'description' => 'Descripcion de prueba'],
                ['id' => 2, 'name' => 'Reparación', 'description' => 'Descripcion de prueba'],
                ['id' => 3, 'name' => 'Enderezado de Pipas', 'description' => 'Descripcion de prueba'],
                ['id' => 4, 'name' => 'Escaneo', 'description' => 'Descripcion de prueba'],
                ['id' => 5, 'name' => 'Carburación y Fuel Injection', 'description' => 'Descripcion de prueba'],
                ['id' => 6, 'name' => 'Revisión General', 'description' => 'Descripcion de prueba'],
            ]);
        });
    }
}
