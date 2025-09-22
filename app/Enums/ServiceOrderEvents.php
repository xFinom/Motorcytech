<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ServiceOrderEvents: string
{
    use EnumToArray;

    case StatusChange = 'StatusChange';
    case ServiceChange = 'ServiceChange';
    case SparePartQuote = 'SparePartQuote';
    case BillGenerated = 'BillGenerated';
}
