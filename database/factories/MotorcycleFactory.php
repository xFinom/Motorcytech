<?php

namespace Database\Factories;

use App\Models\MotorcycleType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'year' => $this->faker->year(),
            'type_id' => MotorcycleType::factory(),
            'id_cliente' => User::factory(),
        ];
    }
}
