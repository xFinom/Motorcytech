<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ServiceOrderStatus: string
{
    use EnumToArray;

    case Ingresado = 'Ingresado';
    case EnProceso = 'EnProceso';
    case Detenido = 'Detenido';
    case Listo = 'Listo';
    case Finalizado = 'Finalizado';
}
