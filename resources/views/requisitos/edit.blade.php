<!-- resources/views/requisitos/edit.blade.php -->
<x-app-layout>
    @section('title', ''.($requisito->id ? ' ' . $requisito->titulo : ''))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Requisito para {{ $listaRequisito->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('requisitos.update', [$listaRequisito->id, $requisito->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $requisito->titulo }}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control">{{ $requisito->descripcion }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tipo_documento">Tipo de Documento</label>
                            <input type="text" name="tipo_documento" id="tipo_documento" class="form-control" value="{{ $requisito->tipo_documento }}">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control" value="{{ $requisito->estado }}">
                        </div>
                        <div class="form-group">
                            <label for="razon_rechazo">Razón de Rechazo</label>
                            <textarea name="razon_rechazo" id="razon_rechazo" class="form-control">{{ $requisito->razon_rechazo }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
