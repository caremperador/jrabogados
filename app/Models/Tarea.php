<?php

namespace App\Models;

use App\Enums\EstadoTareaEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'tareas';

    protected $fillable = [
        'lista_tareas_id',
        'titulo',
        'descripcion',
        'estado',
    ];

    protected $casts = [
        'estado' =>EstadoTareaEnum::class,
    ];

    public function listaTarea()
    {
        return $this->belongsTo(ListaTarea::class, 'lista_tareas_id');
    }
}
