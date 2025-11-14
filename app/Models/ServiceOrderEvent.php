<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use App\Enums\ServiceOrderEvents;
use Carbon\Carbon;
use Database\Factories\ServiceOrderEventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property ServiceOrderEvents $type
 * @property ApprovalStatus $approval_status
 * @property string $title
 * @property string $description
 * @property array<string, mixed> $data
 * @property Carbon $created_at
 *
 * @property ServiceOrders $serviceOrder
 */
class ServiceOrderEvent extends Model
{
    /** @use HasFactory<ServiceOrderEventFactory> */
    use HasFactory;

    protected $casts = [
        'type' => ServiceOrderEvents::class,
        'approval_status' => ApprovalStatus::class,
        'data' => 'array',
    ];

    protected $fillable = [
        'service_order_id',
        'type',
        'approval_status',
        'title',
        'description',
        'data',
    ];

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrders::class, 'service_order_id', 'id');
    }
}
