<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ServiceOrderStatus;

class ServiceOrders extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceOrdersFactory> */
    use HasFactory;

    protected $fillable = [
        'entry_date',
        'delivery_date',
        'status',
        'note',
    ];

    protected $casts = [
        'status' => ServiceOrderStatus::class,
    ];
}
