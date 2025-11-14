<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Database\Factories\ServiceOrderBillFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $description
 * @property float $price
 * @property PaymentStatus $payment_status
 * @property string $service_order_id
 *
 * @property ServiceOrders $serviceOrder
 */
class ServiceOrderBill extends Model
{
    /** @use HasFactory<ServiceOrderBillFactory> */
    use HasFactory;

    protected $table = 'service_orders_bills';

    protected $fillable = [
        'description',
        'price',
        'payment_status',
        'service_order_id',
    ];

    protected $casts = [
        'payment_status' => PaymentStatus::class,
    ];

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrders::class, 'service_order_id');
    }
}
