<?php

namespace App\Models;

use App\Enums\ServiceOrderStatus;
use Database\Factories\ServiceOrdersFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceOrders extends Model
{
    /** @use HasFactory<ServiceOrdersFactory> */
    use HasFactory;

    use HasUlids;

    protected $fillable = [
        'entry_date',
        'delivery_date',
        'status',
        'note',
    ];

    protected $casts = [
        'status' => ServiceOrderStatus::class,
        'entry_date' => 'datetime',
        'delivery_date' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function motorcycle(): HasOne
    {
        return $this->hasOne(Motorcycle::class, 'id', 'motorcycle_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function spareParts(): HasMany
    {
        return $this->hasMany(ServiceOrderSparePart::class, 'service_order_id', 'id');
    }
}
