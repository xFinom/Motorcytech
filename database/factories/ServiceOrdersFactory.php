<?php

namespace Database\Factories;

use App\Enums\ServiceOrderStatus;
use App\Models\Motorcycle;
use App\Models\Service;
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
            'motorcycle_id' => Motorcycle::query()->inRandomOrder()->value('id'),
            'status' => $this->faker->randomElement(ServiceOrderStatus::cases()),
            'client_id' => User::query()->inRandomOrder()->value('id'),
            'service_id' => Service::query()->inRandomOrder()->value('id'),
            'note' => $this->faker->paragraph(),
        ];
    }
}
