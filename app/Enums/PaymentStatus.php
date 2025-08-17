<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Pagado = 'Pagado';
    case Pendiente = 'Pendiente';
}
