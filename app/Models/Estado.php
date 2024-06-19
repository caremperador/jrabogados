<?php

namespace App\Models;

use App\Enums\EstadoTareaEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estado extends Model
{
    use HasFactory;
    protected $table = 'estados';

    protected $fillable = [
        'estado',
    ];
   /*  protected $casts = [
        'estado' =>EstadoTareaEnum::class,
    ]; */

    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'tarea_estado', 'estado_id', 'tarea_id')
                    ->withTimestamps();
    }

}
