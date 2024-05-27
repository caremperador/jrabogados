<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ListaTarea;
use Illuminate\Http\Request;
use App\Enums\EstadoTareaEnum;

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
        $totalTareas = $listasTarea->tareas->count();
        $tareasCompletadas = $listasTarea->tareas->where('estado', EstadoTareaEnum::COMPLETADA)->count();
        $progreso = $totalTareas > 0 ? ($tareasCompletadas / $totalTareas) * 100 : 0;
        $colorbarra = '';

        if ($progreso < 25) {
            $colorbarra = 'bg-red-500';
        } elseif ($progreso < 50) {
            $colorbarra = 'bg-orange-500';
        } elseif ($progreso < 75) {
            $colorbarra = 'bg-yellow-500';
        } else {
            $colorbarra = 'bg-green-500';
        }

        return view('listas_tareas.show', compact('listasTarea', 'progreso', 'colorbarra'));
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
