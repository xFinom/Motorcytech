<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMessages extends Model
{
    /** @use HasFactory<\Database\Factories\PrivateMessagesFactory> */
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'service_order_id',
    ];
}
