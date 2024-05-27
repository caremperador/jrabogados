<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaTarea extends Model
{
    use HasFactory;
    protected $table = 'listas_tareas';

    protected $fillable = [
        'user_id',
        'nombre',
        'progreso', 
        'estado_pago',
        'adelanto',
        'monto_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'lista_tareas_id');
    }

    public function listasRequisitos() {
        return $this->belongsToMany(ListaRequisito::class);
    }
}
