<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ListaRequisito;
use Illuminate\Support\Facades\Auth;

class ListaRequisitoController extends Controller
{
    public function index()
    {
        $listasRequisitos = ListaRequisito::all();
        return view('listas_requisitos.index', compact('listasRequisitos'));
    }

    public function create()
    {
        // Obtén todos los usuarios excluyendo al usuario autenticado
        $usuarios = User::where('id', '!=', Auth::id())->get();
        return view('listas_requisitos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required',
        ]);

        ListaRequisito::create($request->all());
        return redirect()->route('listas_requisitos.index');
    }

    public function show(ListaRequisito $listasRequisito)
    {
        $listasRequisito->load('requisitos');
        return view('listas_requisitos.show', compact('listasRequisito'));
    }

    public function edit(ListaRequisito $listasRequisito)
    {
        $usuarios = User::all();
        return view('listas_requisitos.edit', compact('listasRequisito', 'usuarios'));
    }

    public function update(Request $request, ListaRequisito $listasRequisito)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required',
        ]);

        $listasRequisito->update($request->all());
        return redirect()->route('listas_requisitos.index');
    }

    public function destroy(ListaRequisito $listasRequisito)
    {
        $listasRequisito->delete();
        return redirect()->route('listas_requisitos.index');
    }
}
