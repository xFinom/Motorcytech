<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            BrandSeeder::class,
            MotorcycleTypeSeeder::class,
        ]);

        if(app()->environment('production')) {
            $this->call([
               ProductionSeeder::class,
            ]);
        } else {
            $this->call([
                UserSeeder::class,
                MotorcycleSeeder::class,
                ServiceOrdersSeeder::class,
                SupplierSeeder::class,
            ]);
        }
    }
}
