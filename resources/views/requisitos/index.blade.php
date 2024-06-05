<!-- resources/views/requisitos/index.blade.php -->
@php
    use App\Enums\EstadoRequisitoEnum;
    use App\Enums\TipoDocumentoEnum;
@endphp
<x-app-layout>
    @section('title', 'Lista de Requisitos')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Requisitos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-4">Requisitos solicitados por el abogado</h3>
                    <div class="space-y-4">
                        @foreach ($requisitos as $requisito)
                            <a href="{{ route('requisitos.show', $requisito->id) }}"
                                class="block bg-gray-100 p-4 rounded-lg shadow-sm hover:bg-gray-200 transition">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-4">
                                        @if ($requisito->tipo_documento == TipoDocumentoEnum::PDF)
                                            <i class="fas fa-file-pdf text-red-500 text-2xl mr-4"></i>
                                        @elseif ($requisito->tipo_documento == TipoDocumentoEnum::FOTO)
                                            <i class="fas fa-file-image text-gray-500 text-2xl mr-4"></i>
                                        @elseif ($requisito->tipo_documento == TipoDocumentoEnum::VIDEO)
                                            <i class="fas fa-file-video text-blue-500 text-2xl mr-4"></i>
                                        @elseif ($requisito->tipo_documento == TipoDocumentoEnum::DOCUMENTO)
                                            <i class="fas fa-file-alt text-blue-500 text-2xl mr-4"></i>
                                        @endif
                                        <div>
                                            <p class="text-lg font-semibold">{{ $requisito->titulo }}</p>
                                            <p>{{ $requisito->descripcion }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        @if ($requisito->estado == EstadoRequisitoEnum::NO_SUBIDO)
                                            <span class="text-gray-500 font-bold"><i
                                                    class="fas fa-circle text-gray-500"></i> No subido</span>
                                        @elseif ($requisito->estado == EstadoRequisitoEnum::REVISANDO)
                                            <span class="text-orange-500 font-bold"><i
                                                    class="fas fa-circle text-orange-500"></i> Revisando</span>
                                        @elseif ($requisito->estado == EstadoRequisitoEnum::RECHAZADO)
                                            <span class="text-red-500 font-bold"><i
                                                    class="fas fa-circle text-red-500"></i> Rechazado</span>
                                        @elseif ($requisito->estado == EstadoRequisitoEnum::APROVADO)
                                            <span class="text-green-500 font-bold"><i
                                                    class="fas fa-circle text-green-500"></i> Aprobado</span>
                                        @endif
                                    </div>
                                </div>
                                @if ($requisito->estado == EstadoRequisitoEnum::RECHAZADO)
                                    <div class="text-red-500 mb-2">
                                        <strong>Razón de rechazo:</strong> {{ $requisito->razon_rechazo }}
                                    </div>
                                @endif
                                <hr class="mt-2">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
