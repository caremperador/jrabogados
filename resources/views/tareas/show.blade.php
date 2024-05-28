<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de la Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <h3 class="text-2xl font-bold mb-2">{{ $tarea->titulo }}</h3>
                        <p><strong>Lista de Tareas:</strong> {{ $tarea->listaTarea->nombre }}</p>
                        <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                    </div>
                    <a href="{{ route('tareas.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
