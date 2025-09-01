<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ReviewStatus;

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
