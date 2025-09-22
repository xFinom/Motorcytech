<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use App\Enums\ServiceOrderEvents;
use Database\Factories\ServiceOrderEventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceOrderEvent extends Model
{
    /** @use HasFactory<ServiceOrderEventFactory> */
    use HasFactory;

    protected $casts = [
        'type' => ServiceOrderEvents::class,
        'status' => ApprovalStatus::class,
        'data' => 'array',
    ];

    protected $fillable = [
        'service_order_id',
        'type',
        'status',
        'title',
        'description',
        'data',
    ];

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrders::class, 'service_order_id', 'id');
    }
}
