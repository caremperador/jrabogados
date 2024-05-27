<!-- resources/views/listas_tareas/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de la Lista de Tareas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <p><strong>Usuario:</strong> {{ $listasTarea->user->name ?? 'Usuario no asignado' }}</p>
                            <h3>Tareas</h3>
                            <ul class="list-group">
                                @foreach ($listasTarea->tareas as $tarea)
                                    <li class="list-group-item">
                                        {{ $tarea->titulo }} - <strong>Estado:</strong> {{ $tarea->estado }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a href="{{ route('listas_tareas.index') }}" class="btn btn-secondary mt-3">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
