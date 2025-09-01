<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserRole: string
{
    use EnumToArray;

    case Admin = 'Admin';
    case Trabajador = 'Trabajador';
    case Cliente = 'Cliente';
}
