<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItems extends Model
{
    /** @use HasFactory<\Database\Factories\StoreItemsFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'description',
        'image',
    ];

        public function purchaseOrders()
    {
        return $this->belongsToMany(
            PurchaseOrders::class,
            'purchase_order_items',
            'item_id',
            'purchase_order_id'
        );
    }
}
