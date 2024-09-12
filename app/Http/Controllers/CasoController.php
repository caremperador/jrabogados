<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tarea;
use App\Models\Estado;
use App\Models\Caso;
use App\Models\ListaRequisito;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CasoController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Consulta inicial
        $query = Caso::with('user');

        // Si el usuario no es admin o asistente, filtrar solo por sus casos
        if (!$user->hasRole('admin') && !$user->hasRole('asistente')) {
            $query->where('user_id', $user->id);
        }

        // Aplicar filtros
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('cliente')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->cliente . '%');
            });
        }

        if ($request->filled('estado_pago')) {
            $query->where('estado_pago', $request->estado_pago);
        }

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        // Obtener los casos filtrados
        $casos = $query->orderBy('created_at', 'desc')->get();

        return view('casos.index', compact('casos'));
    }



    public function create()
    {
        $usuarios = User::all();
        $tareas = Tarea::all();
        $listas_requisitos = ListaRequisito::all();
        return view('casos.create', compact('usuarios', 'tareas', 'listas_requisitos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'fecha_limite' => 'nullable|date',
            'monto_total' => 'required|numeric',
            'adelanto' => 'nullable|numeric',
            'estado_pago' => 'required|string|in:sin_pagar,pago_completo,pago_incompleto',
            'tareas' => 'nullable|array',
            'tareas.*' => 'exists:tareas,id',
            'listas_requisitos' => 'nullable|array',
            'listas_requisitos.*' => 'exists:listas_requisitos,id',
        ]);

        $adelanto = $request->adelanto ?? 0.00;

        $caso = Caso::create([
            'user_id' => $request->user_id,
            'nombre' => $request->nombre,
            'fecha_limite' => $request->fecha_limite,
            'monto_total' => $request->monto_total,
            'adelanto' => $adelanto,
            'estado_pago' => $request->estado_pago,
            'progreso' => 0,
        ]);

        if ($request->has('tareas')) {
            $estadoNoIniciada = Estado::where('estado', 'no_iniciada')->firstOrFail();
            foreach ($request->tareas as $tareaId) {
                $caso->tareas()->attach($tareaId);
                $tarea = Tarea::find($tareaId);
                $tarea->estados()->sync([$estadoNoIniciada->id]); // Se asegura que el estado se inicialice correctamente
            }
        }

        if ($request->has('listas_requisitos')) {
            foreach ($request->listas_requisitos as $listaId) {
                $caso->listasRequisitos()->attach($listaId);
            }
        }

        return redirect()->route('casos.index')->with('success', 'Caso creado exitosamente.');
    }


    public function show(Caso $caso)
    {
        $caso->load('user', 'tareas.estados', 'listasRequisitos');

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
        $listas_requisitos = ListaRequisito::all();
        return view('casos.edit', compact('caso', 'usuarios', 'tareas', 'listas_requisitos'));
    }

    public function update(Request $request, Caso $caso)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'fecha_limite' => 'nullable|date',
            'monto_total' => 'required|numeric',
            'adelanto' => 'nullable|numeric',
            'estado_pago' => 'required|string|in:sin_pagar,pago_completo,pago_incompleto',
            'tareas' => 'nullable|array',
            'tareas.*' => 'exists:tareas,id',
            'listas_requisitos' => 'nullable|array',
            'listas_requisitos.*' => 'exists:listas_requisitos,id',
        ]);

        $fecha_limite = $request->fecha_limite ? Carbon::parse($request->fecha_limite) : null;

        $caso->update([
            'user_id' => $request->user_id,
            'nombre' => $request->nombre,
            'fecha_limite' => $fecha_limite,
            'monto_total' => $request->monto_total,
            'adelanto' => $request->adelanto ?? 0.00,
            'estado_pago' => $request->estado_pago,
            'progreso' => $caso->progreso,
        ]);

        // Actualizar las tareas asociadas
        $caso->tareas()->detach();
        if ($request->has('tareas')) {
            $estadoNoIniciada = Estado::where('estado', 'no_iniciada')->firstOrFail();
            foreach ($request->tareas as $tareaId) {
                $caso->tareas()->attach($tareaId);
                $tarea = Tarea::find($tareaId);
                $tarea->estados()->sync([$estadoNoIniciada->id]); // Se asegura que el estado se inicialice correctamente
            }
        }

        // Actualizar las listas de requisitos asociadas
        $caso->listasRequisitos()->detach();
        if ($request->has('listas_requisitos')) {
            foreach ($request->listas_requisitos as $listaId) {
                $caso->listasRequisitos()->attach($listaId);
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
