<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
    ];

    /**
     * Relación: una orden pertenece a un cliente.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Relación: una orden tiene muchos items (relación muchos a muchos).
     */
    public function items()
    {
        return $this->belongsToMany(StoreItems::class, 'purchase_order_items', 'purchase_order_id', 'item_id');
    }
}
