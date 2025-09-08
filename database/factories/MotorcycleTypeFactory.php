<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'type_name' => $this->faker->randomElement(['Deportiva','Enduro', 'Naked', 'Scooter']),
            'model' => $this->faker->year(),
        ];
    }
}
