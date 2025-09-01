<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ReviewStatus: string
{
    use EnumToArray;

    case Pendiente = 'Pendiente';
    case Validado = 'Validado';
}
