<!-- resources/views/requisitos/lista_requisitos.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Requisitos solicitados por el abogado
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="list-group">
                        @foreach ($requisitos as $requisito)
                            <li class="list-group-item">
                                <p><strong>{{ $requisito->titulo }}</strong></p>
                                <p>{{ $requisito->descripcion }}</p>
                                <p><strong>Estado:</strong> 
                                    @if ($requisito->estado == 'no_subido')
                                        <span class="text-secondary">No subido</span>
                                    @elseif ($requisito->estado == 'revisando')
                                        <span class="text-warning">Revisando</span>
                                    @elseif ($requisito->estado == 'rechazado')
                                        <span class="text-danger">Rechazado</span>
                                    @elseif ($requisito->estado == 'aprobado')
                                        <span class="text-success">Aprobado</span>
                                    @endif
                                </p>
                                @if ($requisito->estado == 'rechazado')
                                    <p><strong>Razón de rechazo:</strong> {{ $requisito->razon_rechazo }}</p>
                                @endif
                                @if ($requisito->estado == 'no_subido' || $requisito->estado == 'rechazado')
                                    <form action="{{ route('listas_requisitos.requisitos.update', [$listaRequisito->id, $requisito->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <input type="file" name="archivo" class="form-control mb-2">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
