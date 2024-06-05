<?php

namespace App\Models;

use App\Enums\EstadoPagoEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caso extends Model
{
    use HasFactory;
    protected $table = 'casos';

    protected $fillable = [
        'user_id',
        'nombre',
        'progreso',
        'fecha_limite',
        'estado_pago',
        'adelanto',
        'monto_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'caso_tarea', 'caso_id', 'tarea_id')
                    ->withTimestamps();
    }

    public function listasRequisitos()
    {
        return $this->belongsToMany(ListaRequisito::class, 'lista_requisito_caso', 'caso_id', 'lista_requisito_id')
                    ->withTimestamps();
    }
}
