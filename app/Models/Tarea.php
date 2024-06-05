<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'tareas';

    protected $fillable = [
        'titulo',
        'descripcion',
    ];

    public function casos()
    {
        return $this->belongsToMany(Caso::class, 'caso_tarea', 'tarea_id', 'caso_id')
                    ->withTimestamps();
    }

    public function estados()
    {
        return $this->belongsToMany(Estado::class, 'tarea_estado', 'tarea_id', 'estado_id')
                    ->withTimestamps();
    }
}
