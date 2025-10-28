<?php

namespace Database\Factories;

use App\Models\StoreItems;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StoreItems>
 */
class StoreItemsFactory extends Factory
{
    protected $model = StoreItems::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'quantity' => $this->faker->numberBetween(10, 100),
            'image' => $this->faker->imageUrl(640, 480, 'tech', true),
            'price' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
