<?php

namespace Database\Seeders;

use App\Models\ServiceOrders;
use App\Models\ServiceOrderSparePart;
use Illuminate\Database\Seeder;

class ServiceOrderSparePartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        ServiceOrders::all()->withRelationshipAutoloading()->each(function (ServiceOrders $serviceOrders) use ($sparePartsCatalog) {
            if ($serviceOrders->service->name === 'Reparación') {
                // Pick a random category
                $categories = array_keys($sparePartsCatalog);
                $category = $categories[array_rand($categories)];

                // Pick 1-3 random parts from that category
                $partsInCategory = $sparePartsCatalog[$category];
                shuffle($partsInCategory);
                $numParts = rand(1, 3);
                $partsSelected = array_slice($partsInCategory, 0, $numParts);

                // Create Eloquent models and attach to service order
                $partsModels = [];
                foreach ($partsSelected as $part) {
                    $partsModels[] = new ServiceOrderSparePart([
                        'name' => $part,
                        'quantity' => rand(1, 5),
                        'price' => rand(50, 2000),
                        'payment_status' => 'Pendiente',
                        'approval_status' => 'Pending',
                    ]);
                }

                // Save all parts for this service order
                $serviceOrders->spareParts()->saveMany($partsModels);
            }
        });
    }
}
