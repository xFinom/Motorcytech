<?php

namespace App\Models;

use App\Enums\ReviewStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewsFactory> */
    use HasFactory;

    protected $fillable = [
        'comment',
        'rating',
        'status',
    ];

    protected $casts = [
        'status' => ReviewStatus::class,
    ];
}
