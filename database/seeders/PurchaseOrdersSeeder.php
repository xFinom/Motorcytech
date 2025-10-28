<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrders;
use App\Models\User;

class PurchaseOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all(); // Usuarios existentes

        // Crear 10 órdenes de compra
        foreach (range(1, 10) as $i) {
            // Seleccionar un cliente aleatorio
            $client = $users->random();

            // Crear la orden solo con client_id
            PurchaseOrders::factory()->create([
                'client_id' => $client->id,
            ]);
        }
    }
}
