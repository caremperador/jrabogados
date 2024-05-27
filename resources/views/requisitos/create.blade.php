<!-- resources/views/requisitos/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nuevo Requisito
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">¡Error!</strong>
                            <span class="block sm:inline">Hay algunos problemas con tu entrada.</span>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('requisitos.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="lista_requisitos_id" class="block text-gray-700 font-bold mb-2">Lista de Requisitos</label>
                            <select name="lista_requisitos_id" id="lista_requisitos_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                                @foreach ($listasRequisitos as $listaRequisito)
                                    <option value="{{ $listaRequisito->id }}">{{ $listaRequisito->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="lista_requisitos_id" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="titulo" class="block text-gray-700 font-bold mb-2">Título</label>
                            <input type="text" name="titulo" id="titulo" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500" value="{{ old('titulo') }}">
                            <x-input-error for="titulo" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">{{ old('descripcion') }}</textarea>
                            <x-input-error for="descripcion" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="tipo_documento" class="block text-gray-700 font-bold mb-2">Tipo de Documento</label>
                            <select name="tipo_documento" id="tipo_documento" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                                @foreach ($tipoDocumentoOptions as $option)
                                    <option value="{{ $option->value }}">{{ $option->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="tipo_documento" class="mt-2" />
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
