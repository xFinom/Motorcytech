<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseOrders;
use App\Models\StoreItems;

class PurchaseOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = PurchaseOrders::all();
        $items = StoreItems::all();

        if ($orders->isEmpty() || $items->isEmpty()) {
            $this->command->info('No hay órdenes o items para asociar.');
            return;
        }

        // Crear 20 registros aleatorios en la tabla pivote
        for ($i = 0; $i < 20; $i++) {
            $order = $orders->random();
            $item = $items->random();

            // Evitar duplicados: no asociar el mismo item a la misma orden más de una vez
            if (!$order->items->contains($item->id)) {
                PurchaseOrderItem::factory()->create([
                    'purchase_order_id' => $order->id,
                    'item_id' => $item->id,
                ]);
            }
        }
    }
}

