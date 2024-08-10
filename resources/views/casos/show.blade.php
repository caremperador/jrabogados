@extends('layouts.base')

@section('title', 'Caso ' . $caso->nombre)

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold mb-2">Caso {{ $caso->nombre }}</h3>
    <p class="mb-4"><strong>Usuario:</strong> {{ $caso->user->name ?? 'Usuario no asignado' }}</p>

    <div class="relative pt-1 mb-6">
        <div class="flex mb-2 items-center justify-between">
            <div>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-teal-600 bg-teal-200">
                    Progreso
                </span>
            </div>
            <div class="text-right">
                <span class="text-xs font-semibold inline-block text-teal-600">
                    {{ number_format($progreso, 2) }}%
                </span>
            </div>
        </div>
        <div class="w-full h-9 bg-neutral-200 rounded-full dark:bg-neutral-600 overflow-hidden  border">
            <div class="h-full flex items-center justify-center bg-{{$colorbarra}}-500 text-xs md:text-base font-medium text-white text-centerp-0.5 leading-none rounded-full" style="width: {{ $progreso }}%">
                {{ number_format($progreso, 2) }}%
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <h4 class="font-bold text-center mb-4">Sin empezar</h4>
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            @foreach ($caso->tareas as $tarea)
                @if ($tarea->estados->pluck('estado')->contains(App\Enums\EstadoTareaEnum::NO_INICIADA->value))
                    <div class="bg-white p-2 mb-2 rounded shadow">
                        <a href="{{ route('tareas.show', $tarea->id) }}">{{ $tarea->titulo }}</a>
                        @if (auth()->user()->hasRole(['admin', 'asistente']))
                            <form action="{{ route('tareas.updateEstado', $tarea->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')
                                <select name="estado" onchange="this.form.submit()" class="w-full mt-1 p-1 border rounded">
                                    <option value="{{ App\Enums\EstadoTareaEnum::NO_INICIADA->value }}" selected>Sin empezar</option>
                                    <option value="{{ App\Enums\EstadoTareaEnum::EN_PROCESO->value }}">En proceso</option>
                                    <option value="{{ App\Enums\EstadoTareaEnum::COMPLETADA->value }}">Finalizada</option>
                                </select>
                            </form>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div>
        <h4 class="font-bold text-center mb-4">En proceso</h4>
        <div class="bg-orange-100 p-4 rounded-lg shadow-sm">
            @foreach ($caso->tareas as $tarea)
                @if ($tarea->estados->pluck('estado')->contains(App\Enums\EstadoTareaEnum::EN_PROCESO->value))
                    <div class="bg-white p-2 mb-2 rounded shadow">
                        <a href="{{ route('tareas.show', $tarea->id) }}">{{ $tarea->titulo }}</a>
                        @if (auth()->user()->hasRole(['admin', 'asistente']))
                            <form action="{{ route('tareas.updateEstado', $tarea->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')
                                <select name="estado" onchange="this.form.submit()" class="w-full mt-1 p-1 border rounded">
                                    <option value="{{ App\Enums\EstadoTareaEnum::NO_INICIADA->value }}">Sin empezar</option>
                                    <option value="{{ App\Enums\EstadoTareaEnum::EN_PROCESO->value }}" selected>En proceso</option>
                                    <option value="{{ App\Enums\EstadoTareaEnum::COMPLETADA->value }}">Finalizada</option>
                                </select>
                            </form>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div>
        <h4 class="font-bold text-center mb-4">Finalizadas</h4>
        <div class="bg-green-100 p-4 rounded-lg shadow-sm">
            @foreach ($caso->tareas as $tarea)
                @if ($tarea->estados->pluck('estado')->contains(App\Enums\EstadoTareaEnum::COMPLETADA->value))
                    <div class="bg-white p-2 mb-2 rounded shadow">
                        <a href="{{ route('tareas.show', $tarea->id) }}">{{ $tarea->titulo }}</a>
                        @if (auth()->user()->hasRole(['admin', 'asistente']))
                            <form action="{{ route('tareas.updateEstado', $tarea->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')
                                <select name="estado" onchange="this.form.submit()" class="w-full mt-1 p-1 border rounded">
                                    <option value="{{ App\Enums\EstadoTareaEnum::NO_INICIADA->value }}">Sin empezar</option>
                                    <option value="{{ App\Enums\EstadoTareaEnum::EN_PROCESO->value }}">En proceso</option>
                                    <option value="{{ App\Enums\EstadoTareaEnum::COMPLETADA->value }}" selected>Finalizada</option>
                                </select>
                            </form>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div class="mt-6">
    <h3 class="font-bold text-xl mb-4">Lista de requisitos asociados a este caso:</h3>
    <ul class="list-disc list-inside">
        @foreach ($caso->listasRequisitos as $lista_de_requisitos)
            <li>
                <a href="{{ route('listas_requisitos.show', $lista_de_requisitos->id) }}" class="text-blue-500 hover:underline">{{ $lista_de_requisitos->nombre }}</a>
            </li>
        @endforeach
    </ul>
</div>

<a href="{{ route('casos.index') }}" class="mt-6 inline-block px-4 py-2 bg-gray-500 text-white rounded">Volver</a>
@endsection
