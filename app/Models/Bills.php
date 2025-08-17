<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PaymentStatus;

class Bills extends Model
{
    /** @use HasFactory<\Database\Factories\BillsFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
        'status',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
    ];
}
