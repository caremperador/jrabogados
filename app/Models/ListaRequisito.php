<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaRequisito extends Model
{
    use HasFactory;
    protected $table = 'listas_requisitos';

    protected $fillable = [
        'user_id',
        'nombre',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function requisitos()
    {
        return $this->hasMany(Requisito::class, 'lista_requisitos_id');
    }

    public function casos()
    {
        return $this->belongsToMany(Caso::class, 'lista_requisito_caso', 'lista_requisito_id', 'caso_id')
                    ->withTimestamps();
    }
}
