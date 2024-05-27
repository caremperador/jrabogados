<!-- resources/views/listas_requisitos/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nueva Lista de Requisitos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('listas_requisitos.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="user_id" class="block text-gray-700 font-bold mb-2">Asignar lista a un usuario</label>
                            <select name="user_id" id="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="user_id" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre de la lista</label>
                            <input type="text" name="nombre" id="nombre" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500" value="{{ old('nombre') }}">
                            <x-input-error for="nombre" class="mt-2" />
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
