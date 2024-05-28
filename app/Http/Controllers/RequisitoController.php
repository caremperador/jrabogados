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

    public function search(Request $request, Requisito $requisito) {
        $q = $request->input('q', '');
        $requisitos = Requisito::search($q)->get();
        return response()->json($requisitos);
    }

    public function create(?ListaRequisito $listaRequisito = null)
    {

        $user_id = $listaRequisito?->user_id;

        $tipoDocumentoOptions = TipoDocumentoEnum::cases();

        $listasRequisitos = $listaRequisito?->user?->listasRequisitos ?? ListaRequisito::latest()->get();
        $listaRequisito ??= $listasRequisitos->first();
        $requisitosAsociadosLista = $listaRequisito?->requisitos ?? collect();

        return view('requisitos.create', compact('listasRequisitos', 'listaRequisito', 'tipoDocumentoOptions', 'user_id', 'requisitosAsociadosLista'));
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

        return redirect()->back()->with('success', 'Requisito creado exitosamente.');
    }

    public function update(Request $request, Requisito $requisito)
    {
        
        $request->validate([
            'archivo' => 'required|file|max:2048',
        ]);

        $path = $request->file('archivo')->store('public/requisitos');

        ArchivoRequisito::create([
            'requisito_id' => $requisito->id,
            'archivo' => $path,
        ]);
        $requisito->update([
            'estado' => EstadoRequisitoEnum::REVISANDO,
        ]);

        return redirect()->route('listas_requisitos.show', $requisito->lista_requisitos_id)->with('success', 'Archivo subido exitosamente.');
    }

    public function show(Requisito $requisito)
    {
        return view('requisitos.show', compact('requisito'));
    }
}
