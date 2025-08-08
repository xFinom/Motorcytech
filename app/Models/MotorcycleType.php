<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorcycleType extends Model
{
    /** @use HasFactory<\Database\Factories\MotorcycleTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'type_name',
        'model',
    ];
}
