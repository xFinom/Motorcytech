<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrderBill extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceOrderBillFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
        'payment_status',
        'service_order_id',
    ];

    protected $casts = [
        'payment_status' => PaymentStatus::class,
    ];
}
