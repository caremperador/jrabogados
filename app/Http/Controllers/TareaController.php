<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::with('listaTarea')->get();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lista_tareas_id' => 'required|exists:listas_tareas,id',
            'titulo' => 'required',
            'estado' => 'required',
        ]);

        Tarea::create($request->all());
        return redirect()->route('tareas.index');
    }

    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'lista_tareas_id' => 'required|exists:listas_tareas,id',
            'titulo' => 'required',
            'estado' => 'required',
        ]);

        $tarea->update($request->all());
        return redirect()->route('tareas.index');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index');
    }
}
