<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrderSparePart>
 */
class ServiceOrderSparePartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sparePartsCatalog = [
            'Sistema de refrigeración' => [
                'Ventilador','Materiales eléctricos','Mangueras','Radiador','Termostato','Deposito de anticongelante','Tapón del radiador'
            ],
            'Sistema eléctrico' => [
                'Estator','Batería','Materiales eléctricos','Arnés','Regulador de voltaje'
            ],
            'Frenos' => [
                'Balatas','Caliper','Líneas de freno','Modulador de abs','Manijas de freno','Pedal de freno'
            ],
            'Suspensiones' => [
                'Retenes', 'guardapolvos','Aceites','Nitrógeno','Válvulas de llenado de nitrógeno','Bujes','Dumpers'
            ],
            'Motores' => [
                'Cabeza del motor','Válvulas','Árboles de levas','Cadena de distribución','Sellos de válvula','Monedas de calibración',
                'Pistón','Anillos de pistón','Perno','Biela','Cigüeñal','Caja de cambios','Selector de cambios',
                'Estator','Vendix','Marcha','Engranes','Bomba de aceite','Clutch','Bomba de agua'
            ],
            'Rodamientos' => [
                'Baleros','Masa de llantas','Telescopio','Horquillas','Linkage'
            ],
            'Cambio de llantas' => [
                'Llantas',
                'Cámaras',
                'Rin',
                'Disco ABS'
            ],
            'Kit de arrastre' => [
                'Cadena','Sprocket de motor', 'Sprocket de llanta'
            ],
        ];

        $category = $this->faker->randomElement(array_keys($sparePartsCatalog));

        $parts = $this->faker->randomElements($sparePartsCatalog[$category], rand(1, 3));

        $spareParts = [];
        foreach ($parts as $part) {
            $spareParts[] = [
                'name' => $part,
                'quantity' => rand(1, 5),
                'price' => rand(50, 2000), // synthetic price
                'payment_status' => 'Pendiente',
                'approval_status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Return one part at a time for factory
        return $this->faker->randomElement($spareParts);
    }
}
