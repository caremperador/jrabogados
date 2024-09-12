@extends('layouts.base')

@section('title', 'Lista de Casos')

@section('content')
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('asistente'))
        <div class="mb-4">
            <a href="{{ route('casos.create') }}"
                class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                Crear Nuevo Caso
            </a>
        </div>
    @endif

    <!-- Formulario de búsqueda y filtros -->
    <form method="GET" action="{{ route('casos.index') }}" class="mb-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Caso</label>
                <input type="text" name="nombre" id="nombre" value="{{ request('nombre') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="cliente" class="block text-sm font-medium text-gray-700">Nombre del Cliente</label>
                <input type="text" name="cliente" id="cliente" value="{{ request('cliente') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="estado_pago" class="block text-sm font-medium text-gray-700">Estado de Pago</label>
                <select name="estado_pago" id="estado_pago" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Todos --</option>
                    <option value="sin_pagar" {{ request('estado_pago') == 'sin_pagar' ? 'selected' : '' }}>Sin pagar
                    </option>
                    <option value="pago_completo" {{ request('estado_pago') == 'pago_completo' ? 'selected' : '' }}>Pagado
                        completo</option>
                    <option value="pago_incompleto" {{ request('estado_pago') == 'pago_incompleto' ? 'selected' : '' }}>Pago
                        incompleto</option>
                </select>
            </div>

            <div>
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ request('fecha_inicio') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ request('fecha_fin') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                Buscar
            </button>
            <a href="{{ route('casos.index') }}"
                class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-gray-500">
                Limpiar
            </a>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col"
                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col"
                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                    <th scope="col"
                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Usuario
                    </th>
                    <th scope="col"
                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Progreso
                    </th>
                    <th scope="col"
                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado de Pago
                    </th>
                    <th scope="col"
                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Falta Pagar
                    </th>
                    <th scope="col"
                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($casos as $caso)
                    <tr>
                        <td class="px-2 py-4 whitespace-nowrap">
                            {{ $caso->id }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            <span class="truncate" title="{{ $caso->nombre }}">{{ $caso->nombre }}</span>
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            {{ $caso->user->name }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            {{ $caso->progreso }}%
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            @if ($caso->estado_pago == 'sin_pagar')
                                <span class="text-red-500">Sin pagar</span>
                            @elseif ($caso->estado_pago == 'pago_completo')
                                <span class="text-green-500">Pagado completo</span>
                            @elseif ($caso->estado_pago == 'pago_incompleto')
                                <span class="text-yellow-500">Pago incompleto</span>
                            @endif
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            S/ {{ number_format($caso->falta_por_pagar, 2) }}
                        </td>
                        <td class="px-2 py-4 whitespace-nowrap">
                            <a href="{{ route('casos.show', $caso->id) }}" class="text-blue-500 hover:underline">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('asistente'))
                                <a href="{{ route('casos.edit', $caso->id) }}" class="text-yellow-500 hover:underline ml-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('casos.destroy', $caso->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-3">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection
