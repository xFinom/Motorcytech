<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PaymentStatus;

class SpareParts extends Model
{
    /** @use HasFactory<\Database\Factories\SparePartsFactory> */
    use HasFactory;

     protected $fillable = [
        'name_sparepart',
        'price',
        'status',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
    ];
}
