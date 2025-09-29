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
            // Catalogs
            ServiceSeeder::class,
            BrandSeeder::class,
            MotorcycleTypeSeeder::class,

            UserSeeder::class,
            MotorcycleSeeder::class,
            ServiceOrdersSeeder::class,
            SupplierSeeder::class,
        ]);
    }
}
