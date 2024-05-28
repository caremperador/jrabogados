<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\ListaTarea;
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
        $listasTareas = ListaTarea::all();
        return view('tareas.create', compact('listasTareas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'lista_tareas_id' => 'required|exists:listas_tareas,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Tarea::create($request->all());
        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    public function show(Tarea $tarea)
    {
        $tarea->load('listaTarea');
        return view('tareas.show', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        $listasTareas = ListaTarea::all();
        return view('tareas.edit', compact('tarea', 'listasTareas'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'lista_tareas_id' => 'required|exists:listas_tareas,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tarea->update($request->all());
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
