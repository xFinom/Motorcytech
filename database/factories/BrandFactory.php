<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'name' => $this->faker->randomElement([
                'Honda',
                'Kawasaki',
                'BMW',
                'Suzuki',
                'Triumph',
                'Bajaj',
                'Yamaha',
                'Ducati',
                'KTM',
            ]),

            'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'logo'),
        ];
    }
}
