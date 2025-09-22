<?php

namespace Database\Seeders;

use App\Models\MotorcycleType;
use Illuminate\Database\Seeder;

class MotorcycleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MotorcycleType::factory(4)->create();
    }
}
