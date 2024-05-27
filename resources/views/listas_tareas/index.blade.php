<!-- resources/views/listas_tareas/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listas de Tareas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('listas_tareas.create') }}" class="btn btn-primary mb-3">Crear Nueva Lista de Tareas</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listasTareas as $listaTarea)
                                <tr>
                                    <td>{{ $listaTarea->id }}</td>
                                    <td>{{ $listaTarea->nombre }}</td>
                                    <td>{{ $listaTarea->user->name }}</td>
                                    <td>
                                        <a href="{{ route('listas_tareas.show', $listaTarea->id) }}" class="btn btn-info">Ver</a>
                                        <a href="{{ route('listas_tareas.edit', $listaTarea->id) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('listas_tareas.destroy', $listaTarea->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
