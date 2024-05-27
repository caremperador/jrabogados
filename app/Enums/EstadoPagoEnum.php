<?php

namespace App\Enums;

enum EstadoPagoEnum:string
{
    case SIN_PAGAR = 'sin_pagar';
    case PAGO_COMPLETO = 'pago_completo';
    case PAGO_INCOMPLETO = 'pago_incompleto';
}
