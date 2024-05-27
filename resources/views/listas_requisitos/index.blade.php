<!-- resources/views/listas_requisitos/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listas de Requisitos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('listas_requisitos.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                            Crear Nueva Lista de Requisitos
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Usuario
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($listasRequisitos as $listaRequisito)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $listaRequisito->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $listaRequisito->nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $listaRequisito->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('listas_requisitos.show', $listaRequisito->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                            <a href="{{ route('listas_requisitos.edit', $listaRequisito->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-3">Editar</a>
                                            <form action="{{ route('listas_requisitos.destroy', $listaRequisito->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-3">Eliminar</button>
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
