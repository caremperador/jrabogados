@extends('layouts.base')

@section('title', 'Lista de Usuarios')

@section('content')
    <div class="mb-4">
        <a href="{{ route('users.create') }}"
            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
            Crear Nuevo Usuario
        </a>
    </div>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Buscar Usuario</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Buscar por nombre o email">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                Buscar
            </button>
            <a href="{{ route('users.index') }}"
                class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-gray-500">
                Limpiar
            </a>
        </div>
    </form>

    <!-- Tabla de usuarios -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Teléfono WhatsApp
                    </th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        País
                    </th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-2 py-4 whitespace-nowrap">
                            {{ $user->id }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            {{ $user->name }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            {{ $user->email }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            {{ $user->telefono_whatsapp }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            {{ $user->pais }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-500 hover:underline">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500 hover:underline ml-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-3">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
