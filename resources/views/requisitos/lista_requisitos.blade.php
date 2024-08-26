<!-- resources/views/requisitos/lista_requisitos.blade.php -->
@extends('layouts.base')

@section('title', 'Requisitos solicitados por el abogado')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <ul class="list-disc list-inside">
                    @foreach ($requisitos as $requisito)
                        <li class="mb-4">
                            <h3 class="text-lg font-bold">{{ $requisito->titulo }}</h3>
                            <p>{{ $requisito->descripcion }}</p>
                            <p><strong>Estado:</strong> 
                                @if ($requisito->estado == 'no_subido')
                                    <span class="text-gray-500">No subido</span>
                                @elseif ($requisito->estado == 'revisando')
                                    <span class="text-yellow-500">Revisando</span>
                                @elseif ($requisito->estado == 'rechazado')
                                    <span class="text-red-500">Rechazado</span>
                                @elseif ($requisito->estado == 'aprobado')
                                    <span class="text-green-500">Aprobado</span>
                                @endif
                            </p>
                            @if ($requisito->estado == 'rechazado')
                                <p><strong>Razón de rechazo:</strong> {{ $requisito->razon_rechazo }}</p>
                            @endif
                            @if ($requisito->estado == 'no_subido' || $requisito->estado == 'rechazado')
                                <form action="{{ route('listas_requisitos.requisitos.update', [$listaRequisito->id, $requisito->id]) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <input type="file" name="archivo" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                                    </div>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">Subir Archivo</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
