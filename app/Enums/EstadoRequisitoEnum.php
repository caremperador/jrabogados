<?php

namespace App\Enums;

enum EstadoRequisitoEnum:string
{
    case NO_SUBIDO = 'no_subido';
    case REVISANDO = 'revisando';
    case RECHAZADO = 'rechazado';
    case APROVADO = 'aprovado';
}
