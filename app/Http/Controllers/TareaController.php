<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Caso;
use App\Models\Estado;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::with('casos', 'estados')->get();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        $casos = Caso::all();
        $estados = Estado::all();
        return view('tareas.create', compact('casos', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'caso_id' => 'required|exists:casos,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado_id' => 'required|exists:estados,id',
        ]);

        $tarea = Tarea::create($request->only(['titulo', 'descripcion']));

        // Asociar la tarea con el caso y el estado
        $tarea->casos()->attach($request->caso_id);
        $tarea->estados()->attach($request->estado_id);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    public function show(Tarea $tarea)
    {
        $tarea->load('casos', 'estados');
        return view('tareas.show', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        $casos = Caso::all();
        $estados = Estado::all();
        return view('tareas.edit', compact('tarea', 'casos', 'estados'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'caso_id' => 'required|exists:casos,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado_id' => 'required|exists:estados,id',
        ]);

        $tarea->update($request->only(['titulo', 'descripcion']));

        // Actualizar las asociaciones de caso y estado
        $tarea->casos()->sync([$request->caso_id]);
        $tarea->estados()->sync([$request->estado_id]);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
