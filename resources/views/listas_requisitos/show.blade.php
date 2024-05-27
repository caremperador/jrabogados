<!-- resources/views/listas_requisitos/show.blade.php -->
@php
    use App\Enums\EstadoRequisitoEnum;
    use App\Enums\TipoDocumentoEnum;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de la Lista de Requisitos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <h3 class="text-2xl font-bold mb-2">{{ $listasRequisito->nombre }}</h3>
                        <p><strong>Usuario:</strong> {{ $listasRequisito->user->name }}</p>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Requisitos solicitados por el {{ $listasRequisito->user->name }}
                    </h3>
                    <div class="space-y-4">
                        @foreach ($listasRequisito->requisitos as $requisito)
                            <a href="{{ route('requisitos.show', $requisito->id) }}"
                                class="block p-4 bg-gray-100 rounded-lg hover:bg-gray-200">
                                <div class="flex items-center justify-between ">
                                    <div class="flex items-center space-x-4">
                                        @if ($requisito->tipo_documento == TipoDocumentoEnum::DOCUMENTO)
                                            <i class="fas fa-file-alt text-blue-500 text-2xl"></i>
                                        @elseif ($requisito->tipo_documento == TipoDocumentoEnum::PDF)
                                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                                        @elseif ($requisito->tipo_documento == TipoDocumentoEnum::FOTO)
                                            <i class="fas fa-file-image text-gray-500 text-2xl"></i>
                                        @elseif ($requisito->tipo_documento == TipoDocumentoEnum::VIDEO)
                                            <i class="fas fa-file-video text-blue-500 text-2xl"></i>
                                        @endif

                                        <div>
                                            <p class="text-lg font-semibold">{{ $requisito->titulo }}</p>
                                            <p>{{ $requisito->descripcion }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        @if ($requisito->estado == EstadoRequisitoEnum::NO_SUBIDO)
                                            <span class="text-red-500 font-bold "><i
                                                    class="fas fa-circle text-red-500"></i> No subido</span>
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
                            </a>
                        @endforeach
                    </div>
                    <a href="{{ route('listas_requisitos.index') }}"
                        class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
