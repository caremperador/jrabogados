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
                    <a href="{{ route('listas_tareas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Crear Nueva Lista de Tareas</a>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">ID</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Usuario</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($listasTareas as $listaTarea)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $listaTarea->id }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $listaTarea->nombre }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $listaTarea->user->name }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">
                                            <a href="{{ route('listas_tareas.show', $listaTarea->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Ver</a>
                                            <a href="{{ route('listas_tareas.edit', $listaTarea->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                                            <form action="{{ route('listas_tareas.destroy', $listaTarea->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
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
    </div>
</x-app-layout>
