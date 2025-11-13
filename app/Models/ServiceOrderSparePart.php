<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use App\Enums\PaymentStatus;
use Database\Factories\ServiceOrderSparePartFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property int $quantity
 * @property float $price
 * @property PaymentStatus $payment_status
 * @property ApprovalStatus $approval_status
 *
 * @property ServiceOrders $serviceOrder
 */
class ServiceOrderSparePart extends Model
{
    /** @use HasFactory<ServiceOrderSparePartFactory> */
    use HasFactory;

    protected $table = 'service_orders_spare_parts';

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'payment_status',
        'approval_status',
        'service_order_id',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
        'approval_status' => ApprovalStatus::class,
    ];

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrders::class, 'service_order_id');
    }
}
