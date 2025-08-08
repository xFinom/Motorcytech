<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'Admin';
    case Trabajador = 'Trabajador';
    case Cliente = 'Cliente';
}
