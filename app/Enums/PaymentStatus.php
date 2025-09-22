<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PaymentStatus: string
{
    use EnumToArray;

    case Pagado = 'Pagado';
    case Pendiente = 'Pendiente';
}
