<?php

namespace Database\Factories;

use App\Models\PurchaseOrders;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrders>
 */
class PurchaseOrdersFactory extends Factory
{
    protected $model = PurchaseOrders::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Si no hay usuarios, Laravel creará uno automáticamente
            'client_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

