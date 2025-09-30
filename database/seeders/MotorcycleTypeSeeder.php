<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\MotorcycleType;
use Illuminate\Database\Seeder;

class MotorcycleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::all();

        foreach ($brands as $brand) {
            $brand->motorcycleTypes()->createMany([
                ['name' => 'Deportiva'],
                ['name' => 'Enduro'],
                ['name' => 'Naked'],
                ['name' => 'Scooter'],
            ]);
        }

//        MotorcycleType::factory(4)->create();
    }
}
