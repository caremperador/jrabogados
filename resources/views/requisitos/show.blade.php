<!-- resources/views/requisitos/show.blade.php -->
@php
    use App\Enums\EstadoRequisitoEnum;
    use App\Enums\TipoDocumentoEnum;
@endphp

@extends('layouts.base')

@section('title', 'Requisito ' . $requisito->titulo)

@section('content')
    <div class="mb-6">
        <h3 class="text-2xl font-bold mb-2">{{ $requisito->titulo }}</h3>
    </div>
    <div class="space-y-4">
        <div class="flex items-center">
            <p class="text-lg"><strong>Descripción:</strong> {{ $requisito->descripcion }}</p>
        </div>
        <div class="flex items-center">
            @if ($requisito->tipo_documento == TipoDocumentoEnum::PDF)
                <i class="fas fa-file-pdf text-red-500 text-2xl mr-4"></i>
            @elseif ($requisito->tipo_documento == TipoDocumentoEnum::FOTO)
                <i class="fas fa-file-image text-gray-500 text-2xl mr-4"></i>
            @elseif ($requisito->tipo_documento == TipoDocumentoEnum::VIDEO)
                <i class="fas fa-file-video text-blue-500 text-2xl mr-4"></i>
            @elseif ($requisito->tipo_documento == TipoDocumentoEnum::DOCUMENTO)
                <i class="fas fa-file-alt text-blue-500 text-2xl mr-4"></i>
            @endif
            <p class="text-lg"><strong>Tipo de Documento:</strong> {{ $requisito->tipo_documento }}</p>
        </div>
        <div class="flex items-center">
            <i class="fas fa-info-circle text-gray-500 text-2xl mr-4"></i>
            <p class="text-lg"><strong>Estado:</strong>
                @if ($requisito->estado == EstadoRequisitoEnum::NO_SUBIDO)
                    <span class="text-red-500 font-bold"><i class="fas fa-circle text-red-500"></i> No subido</span>
                @elseif ($requisito->estado == EstadoRequisitoEnum::REVISANDO)
                    <span class="text-orange-500 font-bold"><i class="fas fa-circle text-orange-500"></i> Revisando</span>
                @elseif ($requisito->estado == EstadoRequisitoEnum::RECHAZADO)
                    <span class="text-red-500 font-bold"><i class="fas fa-circle text-red-500"></i> Rechazado</span>
                @elseif ($requisito->estado == EstadoRequisitoEnum::APROVADO)
                    <span class="text-green-500 font-bold"><i class="fas fa-circle text-green-500"></i> Aprobado</span>
                @endif
            </p>
        </div>
        @if ($requisito->razon_rechazo)
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 text-2xl mr-4"></i>
                <p class="text-lg"><strong>Razón de Rechazo:</strong> {{ $requisito->razon_rechazo }}</p>
            </div>
        @endif

        @if (auth()->check() &&
                auth()->user()->hasRole(['admin', 'asistente']))
            <form action="{{ route('requisitos.updateEstado', [$requisito->id]) }}" method="POST" id="estadoForm"
                class="mt-4">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="estado" class="block text-gray-700 font-bold mb-2">Actualizar Estado</label>
                    <select name="estado" id="estado"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500"
                        onchange="handleEstadoChange(this)">
                        <option value="{{ EstadoRequisitoEnum::NO_SUBIDO }}"
                            {{ $requisito->estado == EstadoRequisitoEnum::NO_SUBIDO ? 'selected' : '' }}>No subido</option>
                        <option value="{{ EstadoRequisitoEnum::REVISANDO }}"
                            {{ $requisito->estado == EstadoRequisitoEnum::REVISANDO ? 'selected' : '' }}>Revisando</option>
                        <option value="{{ EstadoRequisitoEnum::RECHAZADO }}"
                            {{ $requisito->estado == EstadoRequisitoEnum::RECHAZADO ? 'selected' : '' }}>Rechazado</option>
                        <option value="{{ EstadoRequisitoEnum::APROVADO }}"
                            {{ $requisito->estado == EstadoRequisitoEnum::APROVADO ? 'selected' : '' }}>Aprobado</option>
                    </select>
                </div>

                <!-- Campo para el motivo del rechazo -->
                <div id="motivoRechazoContainer" class="mb-4" style="display: none;">
                    <label for="razon_rechazo" class="block text-gray-700 font-bold mb-2">Motivo del Rechazo</label>
                    <textarea name="razon_rechazo" id="razon_rechazo" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">{{ old('razon_rechazo', $requisito->razon_rechazo) }}</textarea>
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">Actualizar
                    Estado</button>
            </form>
        @endif


        @php
            $showUploadForm =
                $requisito->estado == EstadoRequisitoEnum::NO_SUBIDO ||
                $requisito->estado == EstadoRequisitoEnum::RECHAZADO;
        @endphp

        @if ($showUploadForm)
            <form action="{{ route('requisitos.update', [$requisito->id]) }}" method="POST" enctype="multipart/form-data"
                class="mt-4">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="archivo" class="block text-gray-700 font-bold mb-2">Subir Archivo</label>
                    <input type="file" name="archivo" id="archivo"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500 mb-2">
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">Subir
                    Archivo</button>
            </form>
        @else
            <h4 class="text-lg font-semibold mb-2">Archivos Subidos:</h4>
        @endif

        <div>
            <ul>
                @foreach ($requisito->archivos as $archivo)
                    <li>
                        <a href="{{ Storage::url($archivo->archivo) }}" target="_blank" class="text-blue-500 underline">
                            {{ basename($archivo->archivo) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <a href="{{ route('listas_requisitos.show', $requisito->lista_requisitos_id) }}"
        class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">Volver</a>
@endsection

<script>
function handleEstadoChange(selectElement) {
    var selectedValue = selectElement.value;
    var motivoRechazoContainer = document.getElementById('motivoRechazoContainer');

    if (selectedValue == '{{ EstadoRequisitoEnum::RECHAZADO }}') {
        motivoRechazoContainer.style.display = 'block';
    } else {
        motivoRechazoContainer.style.display = 'none';
    }
}

</script>
