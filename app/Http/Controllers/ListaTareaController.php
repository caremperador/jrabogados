<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tarea;
use App\Models\ListaTarea;
use App\Models\EstadoTarea;
use Illuminate\Http\Request;
use App\Enums\EstadoTareaEnum;

class ListaTareaController extends Controller
{
    public function index()
    {
        $listasTareas = ListaTarea::with('user')->orderBy('created_at', 'desc')->get();
        return view('listas_tareas.index', compact('listasTareas'));
    }


    public function create()
    {
        $usuarios = User::all();
        $tareas = Tarea::all();
        return view('listas_tareas.create', compact('usuarios', 'tareas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'tareas' => 'nullable|array',
            'tareas.*' => 'exists:tareas,id',
        ]);

        $listaTarea = ListaTarea::create($request->only(['user_id', 'nombre']));

        if ($request->has('tareas')) {
            foreach ($request->tareas as $tareaId) {
                $listaTarea->tareas()->attach($tareaId, ['estado' => 'no_iniciada']);
            }
        }

        return redirect()->route('listas_tareas.index')->with('success', 'Lista de tareas creada exitosamente.');
    }
    public function show(ListaTarea $listasTarea)
    {
        $listasTarea->load('user', 'tareas');
        $totalTareas = $listasTarea->tareas->count();
        $tareasCompletadas = $listasTarea->tareas->where('estado', EstadoTareaEnum::COMPLETADA)->count();
        $progreso = $totalTareas > 0 ? ($tareasCompletadas / $totalTareas) * 100 : 0;

        // Actualizar el campo progreso en la base de datos
        $listasTarea->update(['progreso' => $progreso]);

        // Determinar el color de la barra de progreso
        $colorbarra = '';
        if ($progreso < 25) {
            $colorbarra = 'red';
        } elseif ($progreso < 50) {
            $colorbarra = 'orange';
        } elseif ($progreso < 75) {
            $colorbarra = 'yellow';
        } else {
            $colorbarra = 'green';
        }
        //calculando el lo que falta pagar del caso
        $falta_por_pagar = $listasTarea->monto_total - $listasTarea->adelanto;

        return view('listas_tareas.show', compact('listasTarea', 'progreso', 'colorbarra', 'falta_por_pagar'));
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
