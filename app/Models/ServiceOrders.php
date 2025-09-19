<?php

namespace App\Models;

use Database\Factories\ServiceOrdersFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ServiceOrderStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceOrders extends Model
{
    /** @use HasFactory<ServiceOrdersFactory> */
    use HasFactory;

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
}
