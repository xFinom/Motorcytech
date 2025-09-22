<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Throwable;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Throwable
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('services')->insert([
                ['id' => 1, 'name' => 'Mantenimiento Preventivo', 'description' => fake()->paragraph()],
                ['id' => 2, 'name' => 'Reparación', 'description' => fake()->paragraph()],
                ['id' => 3, 'name' => 'Enderezado de Pipas', 'description' => fake()->paragraph()],
                ['id' => 4, 'name' => 'Escaneo', 'description' => fake()->paragraph()],
                ['id' => 5, 'name' => 'Carburación y Fuel Injection', 'description' => fake()->paragraph()],
                ['id' => 6, 'name' => 'Revisión General', 'description' => fake()->paragraph()],
            ]);
        });
    }
}
