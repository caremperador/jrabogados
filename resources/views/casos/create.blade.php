@extends('layouts.base')

@section('title', 'Crear Nuevo Caso')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('casos.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 font-bold mb-2">Usuario</label>
                        <select name="user_id" id="user_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="user_id" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                        <x-input-error for="nombre" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="fecha_limite" class="block text-gray-700 font-bold mb-2">Fecha Límite</label>
                        <input type="date" name="fecha_limite" id="fecha_limite"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                        <x-input-error for="fecha_limite" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="monto_total" class="block text-gray-700 font-bold mb-2">Monto Total</label>
                        <input type="number" step="0.01" name="monto_total" id="monto_total"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                        <x-input-error for="monto_total" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="adelanto" class="block text-gray-700 font-bold mb-2">Adelanto</label>
                        <input type="number" step="0.01" name="adelanto" id="adelanto"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                        <x-input-error for="adelanto" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="estado_pago" class="block text-gray-700 font-bold mb-2">Estado de Pago</label>
                        <select name="estado_pago" id="estado_pago"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                            <option value="sin_pagar">Sin Pagar</option>
                            <option value="pago_completo">Pago Completo</option>
                            <option value="pago_incompleto">Pago Incompleto</option>
                        </select>
                        <x-input-error for="estado_pago" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="tareas" class="block text-gray-700 font-bold mb-2">Seleccionar Tareas</label>
                        <select name="tareas[]" id="tareas" multiple
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                            @foreach ($tareas as $tarea)
                                <option value="{{ $tarea->id }}">{{ $tarea->titulo }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="tareas" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="listas_requisitos" class="block text-gray-700 font-bold mb-2">Seleccionar Listas de Requisitos</label>
                        <select name="listas_requisitos[]" id="listas_requisitos" multiple
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                            @foreach ($listas_requisitos as $lista)
                                <option value="{{ $lista->id }}">{{ $lista->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="listas_requisitos" class="mt-2" />
                    </div>

                    <button type="submit"
                        class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">Crear</button>
                </form>
            </div>
        </div>
    </div>
@endsection
