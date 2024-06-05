<x-app-layout>
    @section('title', 'Crear Nueva Tarea')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nueva Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="caso_id" class="block text-gray-700 font-bold mb-2">Caso</label>
                            <select name="caso_id" id="caso_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                                @foreach ($casos as $caso)
                                    <option value="{{ $caso->id }}">{{ $caso->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="caso_id" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="titulo" class="block text-gray-700 font-bold mb-2">Título</label>
                            <input type="text" name="titulo" id="titulo" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                            <x-input-error for="titulo" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500"></textarea>
                            <x-input-error for="descripcion" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="estado_id" class="block text-gray-700 font-bold mb-2">Estado</label>
                            <select name="estado_id" id="estado_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="estado_id" class="mt-2" />
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
