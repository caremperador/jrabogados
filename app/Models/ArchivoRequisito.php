<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoRequisito extends Model
{
    use HasFactory;
    protected $table = 'archivos_requisitos';

    protected $fillable = [
        'requisito_id',
        'archivo',
    ];

    public function requisito()
    {
        return $this->belongsTo(Requisito::class);
    }
}
