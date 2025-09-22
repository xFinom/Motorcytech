<?php

namespace Database\Seeders;

use App\Models\StoreItems;
use Illuminate\Database\Seeder;

class StoreItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreItems::factory()->count(15)->create();
    }
}
