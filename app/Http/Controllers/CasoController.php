<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tarea;
use App\Models\Estado;
use App\Models\Caso;
use Illuminate\Http\Request;

class CasoController extends Controller
{
    public function index()
    {
        $casos = Caso::with('user')->orderBy('created_at', 'desc')->get();
        return view('casos.index', compact('casos'));
    }

    public function create()
    {
        $usuarios = User::all();
        $tareas = Tarea::all();
        return view('casos.create', compact('usuarios', 'tareas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'tareas' => 'nullable|array',
            'tareas.*' => 'exists:tareas,id',
        ]);

        $caso = Caso::create($request->only(['user_id', 'nombre', 'progreso', 'fecha_limite', 'estado_pago', 'adelanto', 'monto_total']));

        if ($request->has('tareas')) {
            $estadoNoIniciada = Estado::where('estado', 'no_iniciada')->firstOrFail();
            foreach ($request->tareas as $tareaId) {
                $caso->tareas()->attach($tareaId);
                Tarea::find($tareaId)->estados()->attach($estadoNoIniciada->id);
            }
        }

        return redirect()->route('casos.index')->with('success', 'Caso creado exitosamente.');
    }

    public function show(Caso $caso)
    {
        $caso->load('user', 'tareas.estados');
        
        $totalTareas = $caso->tareas->count();
        $tareasCompletadas = $caso->tareas->filter(function ($tarea) {
            return $tarea->estados->contains('estado', 'completada');
        })->count();
        $progreso = $totalTareas > 0 ? ($tareasCompletadas / $totalTareas) * 100 : 0;
    
        // Actualizar el campo progreso en la base de datos
        $caso->update(['progreso' => $progreso]);
    
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
        
        // Calcular lo que falta pagar del caso
        $falta_por_pagar = $caso->monto_total - $caso->adelanto;
    
        return view('casos.show', compact('caso', 'progreso', 'colorbarra', 'falta_por_pagar'));
    }
    
    
    public function edit(Caso $caso)
    {
        $usuarios = User::all();
        $tareas = Tarea::all();
        return view('casos.edit', compact('caso', 'usuarios', 'tareas'));
    }

    public function update(Request $request, Caso $caso)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'tareas' => 'nullable|array',
            'tareas.*' => 'exists:tareas,id',
        ]);

        $caso->update($request->only(['user_id', 'nombre', 'progreso', 'fecha_limite', 'estado_pago', 'adelanto', 'monto_total']));

        // Actualizar las tareas asociadas
        $caso->tareas()->detach();
        if ($request->has('tareas')) {
            $estadoNoIniciada = Estado::where('estado', 'no_iniciada')->firstOrFail();
            foreach ($request->tareas as $tareaId) {
                $caso->tareas()->attach($tareaId);
                Tarea::find($tareaId)->estados()->attach($estadoNoIniciada->id);
            }
        }

        return redirect()->route('casos.index')->with('success', 'Caso actualizado exitosamente.');
    }

    public function destroy(Caso $caso)
    {
        $caso->delete();
        return redirect()->route('casos.index')->with('success', 'Caso eliminado exitosamente.');
    }
}
