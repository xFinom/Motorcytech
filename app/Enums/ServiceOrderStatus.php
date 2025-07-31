<?php

enum ServiceOrderStatus: string
{
    case Ingresado = 'Ingresado';
    case EnProceso = 'EnProceso';
    case Detenido = 'Detenido';
    case Listo = 'Listo';
    case Finalizado = 'Finalizado';
}