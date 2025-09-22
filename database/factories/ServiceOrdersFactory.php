<?php

namespace Database\Factories;

use App\Enums\ServiceOrderStatus;
use App\Models\Motorcycle;
use App\Models\ServiceOrders;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ServiceOrders>
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
            'service_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6]),
            'note' => $this->faker->paragraph(),
        ];
    }
}
