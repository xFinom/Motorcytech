<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;
use App\Models\MotorcycleType;
use App\Models\User;

class MotorcycleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'placa' => strtoupper($this->faker->bothify('??-###')),
            'serial_num' => strtoupper($this->faker->bothify('SN-#####')),
            'motor_num' => strtoupper($this->faker->bothify('MN-#####')),
            'brand_id' => Brand::factory(),
            'type_id' => MotorcycleType::factory(),
            'id_cliente' => User::factory(),
        ];
    }
}
