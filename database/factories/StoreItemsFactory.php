<?php

namespace Database\Factories;

use App\Enums\PaymentStatus;
use App\Models\StoreItems;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StoreItems>
 */
class StoreItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
