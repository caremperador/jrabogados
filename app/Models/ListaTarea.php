<?php

namespace App\Models;

use App\Enums\EstadoPagoEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected $casts = ['estado_pago' => EstadoPagoEnum::class];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'lista_tareas_id');
    }

    public function listasRequisitos()
    {
        return $this->belongsToMany(ListaRequisito::class);
    }
}
