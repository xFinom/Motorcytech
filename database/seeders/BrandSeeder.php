<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Throwable
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('brands')->insert([
                ['id' => 1, 'name' => 'Honda', 'logo' => 'logo.png'],
                ['id' => 2, 'name' => 'Kawasaki', 'logo' => 'logo.png'],
                ['id' => 3, 'name' => 'BMW', 'logo' => 'logo.png'],
                ['id' => 4, 'name' => 'Suzuki', 'logo' => 'logo.png'],
                ['id' => 5, 'name' => 'Triumph', 'logo' => 'logo.png'],
                ['id' => 6, 'name' => 'Bajaj', 'logo' => 'logo.png'],
                ['id' => 7, 'name' => 'Yamaha', 'logo' => 'logo.png'],
                ['id' => 8, 'name' => 'Ducati', 'logo' => 'logo.png'],
                ['id' => 9, 'name' => 'KTM', 'logo' => 'logo.png'],
                ['id' => 10, 'name' => 'MV Agusta', 'logo' => 'logo.png'],
            ]);
        });
    }
}
