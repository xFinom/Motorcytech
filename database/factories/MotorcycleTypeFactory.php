<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MotorcycleType>
 */
class MotorcycleTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Arr::random(['Deportiva', 'Enduro', 'Naked', 'Scooter']),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        ];
    }
}
