<?php

namespace Database\Factories;

use App\Enums\ServiceOrderStatus;
use App\Models\Motorcycle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrders>
 */
class ServiceOrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::ulid()->toBase32(),
            'entry_date' => $this->faker->date(),
            'delivery_date' => $this->faker->date(),
            'motorcycle_id' => Motorcycle::factory(),
            'status' => $this->faker->randomElement(ServiceOrderStatus::cases()),
            'client_id' => User::factory(),
            'note' => $this->faker->paragraph(),
        ];
    }
}
