<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'serial_num',
        'motor_num',
        'year',
        'type_id',
        'id_cliente',
    ];

    public function type()
    {
        return $this->belongsTo(MotorcycleType::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }
}
