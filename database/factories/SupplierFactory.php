<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companies = [
            'Honda S.A de C.V', 'Suzuki S.A de C.V',
            'Refaccionaria MotoPlus', 'Refaccionaria Moto Race',
            'Refacciones MX', 'MotoRefacciones Express',
            'MotoRefa GDL',
        ];

        $products = [
            'Refacciones varias',
            'Aceite',
            'Limpiadores',
            'Filtros',
            'Llantas',
            'Cascos',
            'Accesorios',
        ];

        return [
            'company' => $this->faker->randomElement($companies),
            'representative' => $this->faker->name(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'product' => $this->faker->randomElement($products),
        ];
    }
}
