<?php

namespace App\Models;

use App\Enums\EstadoRequisitoEnum;
use App\Enums\TipoDocumentoEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;


class Requisito extends Model
{
    use HasFactory;
    use Searchable;
    protected $table = 'requisitos';

    protected $fillable = [
        'lista_requisitos_id',
        'titulo',
        'descripcion',
        'tipo_documento',
        'estado',
        'razon_rechazo',
    ];
    protected $casts = [
        'estado' => EstadoRequisitoEnum::class,
        'tipo_documento' => TipoDocumentoEnum::class
    ];

    #[SearchUsingFullText(['titulo'])]
    public function toSearchableArray(): array
    {
    return [
        'id' => $this->id,
        'titulo' => $this->titulo,
    ];
}

    public function listaRequisito()
    {
        return $this->belongsTo(ListaRequisito::class, 'lista_requisitos_id');
    }
    public function archivos()
    {
        return $this->hasMany(ArchivoRequisito::class);
    }
}
