<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Motorcycle;
use App\Models\MotorcycleType;
use App\Models\User;
use Illuminate\Database\Seeder;

class MotorcycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las marcas, tipos y usuarios existentes
        $brands = Brand::all();
        $types = MotorcycleType::all();
        $users = User::all();

        // Crear 15 motocicletas
        Motorcycle::factory(15)->state(function () use ($brands, $types, $users) {
            return [
                'brand_id' => $brands->random()->id,
                'type_id' => $types->random()->id,
                'id_cliente' => $users->random()->id,
            ];
        })->create();
    }
}
