<?php

namespace App\Http\Controllers;

use App\Models\Requisito;
use Illuminate\Http\Request;
use App\Models\ListaRequisito;
use App\Enums\TipoDocumentoEnum;
use App\Models\ArchivoRequisito;
use App\Enums\EstadoRequisitoEnum;

class RequisitoController extends Controller
{
    public function index()
    {
        $requisitos = Requisito::all();
        // return response()->json($requisitos);
        return view('requisitos.index', compact('requisitos'));
    }

    public function create()
    {
        $listasRequisitos = ListaRequisito::all();
        $tipoDocumentoOptions = TipoDocumentoEnum::cases();
        return view('requisitos.create', compact('listasRequisitos', 'tipoDocumentoOptions'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo_documento' => 'required|string|max:20',
            'lista_requisitos_id' => 'required|exists:listas_requisitos,id',
        ]);

        Requisito::create([
            'lista_requisitos_id' => $request->lista_requisitos_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo_documento' => $request->tipo_documento,
            'estado' => EstadoRequisitoEnum::NO_SUBIDO->value,
        ]);

        return redirect()->route('requisitos.index')->with('success', 'Requisito creado exitosamente.');
    }

    public function update(Request $request, Requisito $requisito)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = $request->file('archivo')->store('public/requisitos');

        ArchivoRequisito::create([
            'requisito_id' => $requisito->id,
            'archivo' => $path,
        ]);
        $requisito->update([
            'estado' => EstadoRequisitoEnum::REVISANDO,
        ]);

        return redirect()->route('requisitos.index')->with('success', 'Archivo subido exitosamente.');
    }

    public function show(Requisito $requisito)
    {
        return view('requisitos.show', compact('requisito'));
    }
}
