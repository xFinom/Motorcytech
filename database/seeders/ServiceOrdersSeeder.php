<?php

namespace Database\Seeders;

use App\Models\ServiceOrders;
use Illuminate\Database\Seeder;

class ServiceOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceOrders::factory()->count(15)->create();
    }
}
