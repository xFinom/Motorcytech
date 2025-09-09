<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
    {
        $empresas = [
            'Honda S.A de C.V', 'Suzuki S.A de C.V',
            'Refaccionaria MotoPlus', 'Refaccionaria Moto Race',
            'Refacciones MX', 'MotoRefacciones Express',
            'MotoRefa GDL'
        ];

        $productos = [
            'Refacciones varias',
            'Aceite',
            'Limpiadores',
            'Filtros',
            'Llantas',
            'Cascos',
            'Accesorios'
        ];

        return [
            'empresa' => $this->faker->randomElement($empresas),
            'representante' => $this->faker->name(),
            'direccion' => $this->faker->address(),
            'correo' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'producto' => $this->faker->randomElement($productos),
        ];
    }
}
