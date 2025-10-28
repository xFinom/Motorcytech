<?php

namespace Database\Factories;

use App\Models\PurchaseOrderItem;
use App\Models\PurchaseOrders;
use App\Models\StoreItems;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrderItem>
 */
class PurchaseOrderItemFactory extends Factory
{
    protected $model = PurchaseOrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtener una orden de compra aleatoria
        $purchaseOrder = PurchaseOrders::inRandomOrder()->first();

        // Obtener un item aleatorio
        $item = StoreItems::inRandomOrder()->first();

        return [
            'purchase_order_id' => $purchaseOrder->id,
            'item_id' => $item->id,
        ];
    }
}
