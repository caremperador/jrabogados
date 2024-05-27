<?php

namespace App\Enums;

enum EstadoTareaEnum:string
{
    case NO_INICIADA = 'no_iniciada';
    case EN_PROCESO = 'en_proceso';
    case COMPLETADA = 'completada';
   
}
