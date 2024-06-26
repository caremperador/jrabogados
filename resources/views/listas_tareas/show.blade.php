@php
    use App\Enums\EstadoTareaEnum;
    use App\Enums\EstadoPagoEnum;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Costo del caso S/ {{ $listasTarea->monto_total }} -
            Estado de pago: @if ($listasTarea->estado_pago == EstadoPagoEnum::SIN_PAGAR)
                <span class="text-red-500">sin pagar</span>
            @elseif ($listasTarea->estado_pago == EstadoPagoEnum::PAGO_COMPLETO)
                <span class="text-green-500">pagado completo</span>
            @elseif ($listasTarea->estado_pago == EstadoPagoEnum::PAGO_INCOMPLETO)
                <span class="text-yellow-500">pago incompleto</span>
            @endif
            - Falta por pagar: S/ {{ $falta_por_pagar }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">Caso {{ $listasTarea->nombre }}</h3>
                        <p class="mb-4"><strong>Usuario:</strong> {{ $listasTarea->user->name ?? 'Usuario no asignado' }}</p>

                        <div class="relative pt-1 mb-6">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-teal-600 bg-teal-200">
                                        Progreso
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-semibold inline-block text-teal-600">
                                        {{ number_format($progreso, 2) }}%
                                    </span>
                                </div>
                            </div>
                            <div class="w-full h-9 bg-gray-200 rounded-full dark:bg-gray-700 overflow-hidden">
                                <div class="h-full flex items-center justify-center bg-{{ $colorbarra }}-500 text-xs md:text-base font-medium text-white text-center p-0.5 leading-none rounded-full" style="width: {{ $progreso }}%">
                                    <span>{{ number_format($progreso, 2) }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <h4 class="font-bold text-center mb-4">Sin empezar</h4>
                            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                                @foreach ($listasTarea->tareas->where('estado', EstadoTareaEnum::NO_INICIADA) as $tarea)
                                    <div class="bg-white p-2 mb-2 rounded shadow">{{ $tarea->titulo }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-center mb-4">En proceso</h4>
                            <div class="bg-orange-100 p-4 rounded-lg shadow-sm">
                                @foreach ($listasTarea->tareas->where('estado', EstadoTareaEnum::EN_PROCESO) as $tarea)
                                    <div class="bg-white p-2 mb-2 rounded shadow">{{ $tarea->titulo }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-center mb-4">Finalizadas</h4>
                            <div class="bg-green-100 p-4 rounded-lg shadow-sm">
                                @foreach ($listasTarea->tareas->where('estado', EstadoTareaEnum::COMPLETADA) as $tarea)
                                    <div class="bg-white p-2 mb-2 rounded shadow">{{ $tarea->titulo }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="font-bold text-xl mb-4">Lista de requisitos asociados a este caso:</h3>
                        <ul class="list-disc list-inside">
                            @foreach ($listasTarea->listasRequisitos as $lista_de_requisitos)
                                <li>
                                    <a href="{{ route('listas_requisitos.show', $lista_de_requisitos->id) }}" class="text-blue-500 hover:underline">{{ $lista_de_requisitos->nombre }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <a href="{{ route('listas_tareas.index') }}" class="mt-6 inline-block px-4 py-2 bg-gray-500 text-white rounded">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
