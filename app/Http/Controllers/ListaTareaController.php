<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ListaTarea;
use Illuminate\Http\Request;

class ListaTareaController extends Controller
{
    public function index()
    {
        $listasTareas = ListaTarea::with('user')->get();
        return view('listas_tareas.index', compact('listasTareas'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('listas_tareas.create', compact('usuarios'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required',
        ]);

        ListaTarea::create($request->all());
        return redirect()->route('listas_tareas.index');
    }

    public function show(ListaTarea $listasTarea)
    {
        $listasTarea->load('user', 'tareas');
        return view('listas_tareas.show', compact('listasTarea'));
    }
    

    public function edit(ListaTarea $listasTarea)
    {
        $usuarios = User::all();
        return view('listas_tareas.edit', compact('listasTarea', 'usuarios'));
    }
    

    public function update(Request $request, ListaTarea $listas_tarea)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
        ]);
    
        $listas_tarea->update($request->all());
    
        return redirect()->route('listas_tareas.index')->with('success', 'Lista de tareas actualizada exitosamente.');
    }
    

    public function destroy(ListaTarea $listas_tarea)
    {
        $listas_tarea->delete();
        return redirect()->route('listas_tareas.index')->with('success', 'Lista de tareas eliminada exitosamente.');
    }
}
