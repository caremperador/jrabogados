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
        // 'estado',
    ];

    /* protected $casts = [
        'estado' =>EstadoTareaEnum::class,
    ];
 */
    public function listaTarea()
    {
        return $this->belongsTo(ListaTarea::class, 'lista_tareas_id');
    }
    /*  public function listaTareas()
    {
        return $this->belongsToMany(ListaTarea::class, 'estado_tareas', 'tarea_id', 'lista_tarea_id')
            ->using(EstadoTarea::class)
            ->withPivot('estado')
            ->withTimestamps();
    } */
    public function estados()
    {
        return $this->hasMany(EstadoTarea::class, 'tarea_id');
    }
}
