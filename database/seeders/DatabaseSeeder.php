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
            UserSeeder::class,
            BrandSeeder::class,
            MotorcycleTypeSeeder::class,
            MotorcycleSeeder::class,
            SupplierSeeder::class,
            ReviewsSeeder::class,
            StoreItemsSeeder::class,
            PurchaseOrdersSeeder::class,
            PurchaseOrderItemSeeder::class,
        ]);
    }
}
