<?php

namespace App\Enums;

enum ReviewStatus: string
{
    case Pendiente = 'Pendiente';
    case Validado = 'Validado';
}