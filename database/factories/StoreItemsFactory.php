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
            'name_sparepart' => $this->faker->name(),
            'price' => $this->faker->numberBetween(100, 1000),
            'status' => $this->faker->randomElement(PaymentStatus::cases()),
        ];
    }
}
