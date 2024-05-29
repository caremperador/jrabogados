<?php

namespace App\Models;

use App\Enums\EstadoTareaEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EstadoTarea extends Pivot
{
    use HasFactory;
    protected $table = 'estado_tareas';

    protected $fillable = [
        'lista_tarea_id',
        'tarea_id',
        'estado',
    ];

    /* protected $casts = [
        'estado' => EstadoTareaEnum::class,
    ]; */

    public function listaTarea()
    {
        return $this->belongsTo(ListaTarea::class, 'lista_tarea_id');
    }

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }
}
