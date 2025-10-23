@extends('layouts.template')

@section('content')

<div class="min-h-screen bg-neutral-100 py-16 px-4">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-900 mb-2">Selecciona tu Vuelo de Regreso</h1>
            <p class="text-blue-600">Completa tu reserva eligiendo el vuelo de regreso</p>
        </div>

        <!-- Resumen del vuelo de ida -->
        <div class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6 mb-8">
            <h2 class="text-xl font-bold text-blue-900 mb-4">Tu Vuelo de Ida</h2>
            <div class="grid md:grid-cols-4 gap-4 bg-blue-50 p-4 rounded-lg">
                <div>
                    <p class="text-sm text-blue-600">Origen</p>
                    <p class="font-semibold text-blue-900">{{ $vueloIda->ciudadOrigen->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-600">Destino</p>
                    <p class="font-semibold text-blue-900">{{ $vueloIda->ciudadDestino->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-600">Fecha y Hora</p>
                    <p class="font-semibold text-blue-900">{{ \Carbon\Carbon::parse($vueloIda->fecha)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($vueloIda->hora)->format('H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-600">Precio</p>
                    <p class="font-semibold text-blue-900">${{ number_format($vueloIda->precio, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Vuelos de regreso disponibles -->
        <div class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6">
            <h2 class="text-xl font-bold text-blue-900 mb-6">Vuelos de Regreso Disponibles</h2>

            @if($vuelosRegreso->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-blue-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-blue-900 font-semibold mb-2">No hay vuelos de regreso disponibles</p>
                    <p class="text-blue-600">Para la fecha y ruta seleccionada</p>
                    <a href="{{ route('vuelos.index') }}" class="inline-block mt-4 px-6 py-3 bg-blue-900 text-white font-semibold rounded-xl hover:bg-blue-800 transition-all duration-200">
                        Buscar otros vuelos
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($vuelosRegreso as $vuelo)
                    <form action="{{ route('reservas.seleccionar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="vuelo_ida_id" value="{{ $vueloIda->id }}">
                        <input type="hidden" name="vuelo_regreso_id" value="{{ $vuelo->id }}">
                        <input type="hidden" name="pasajeros" value="{{ $pasajeros }}">
                        <input type="hidden" name="origen_id" value="{{ $request->origen_id }}">
                        <input type="hidden" name="destino_id" value="{{ $request->destino_id }}">
                        <input type="hidden" name="requiere_regreso" value="{{ $request->requiere_regreso }}">
                        <input type="hidden" name="fecha_regreso" value="{{ $request->fecha_regreso }}">

                        <button type="submit" class="w-full text-left border-2 border-blue-200 rounded-xl p-6 hover:border-blue-600 hover:bg-blue-50 transition-all duration-200 group">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex-1 grid md:grid-cols-5 gap-4">
                                    <!-- Origen -->
                                    <div>
                                        <p class="text-sm text-blue-600 mb-1">Origen</p>
                                        <p class="font-bold text-blue-900 text-lg">{{ $vuelo->ciudadOrigen->nombre }}</p>
                                    </div>

                                    <!-- Flecha -->
                                    <div class="flex items-center justify-center">
                                        <svg class="w-8 h-8 text-blue-600 group-hover:text-blue-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                        </svg>
                                    </div>

                                    <!-- Destino -->
                                    <div>
                                        <p class="text-sm text-blue-600 mb-1">Destino</p>
                                        <p class="font-bold text-blue-900 text-lg">{{ $vuelo->ciudadDestino->nombre }}</p>
                                    </div>

                                    <!-- Fecha y Hora -->
                                    <div>
                                        <p class="text-sm text-blue-600 mb-1">Fecha y Hora</p>
                                        <p class="font-semibold text-blue-900">{{ \Carbon\Carbon::parse($vuelo->fecha)->format('d/m/Y') }}</p>
                                        <p class="text-blue-700">{{ \Carbon\Carbon::parse($vuelo->hora)->format('H:i') }}</p>
                                    </div>

                                    <!-- Precio -->
                                    <div>
                                        <p class="text-sm text-blue-600 mb-1">Precio por pasajero</p>
                                        <p class="font-bold text-blue-900 text-xl">${{ number_format($vuelo->precio, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <!-- Icono de seleccionar -->
                                <div class="flex items-center">
                                    <div class="bg-blue-900 text-white px-6 py-3 rounded-xl group-hover:bg-blue-800 transition-all duration-200">
                                        <span class="font-semibold">Seleccionar</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Info adicional -->
                            <div class="mt-4 pt-4 border-t border-blue-100 grid md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="text-blue-600">Modelo: </span>
                                    <span class="text-blue-900 font-semibold">{{ $vuelo->modeloAvion->nombre }}</span>
                                </div>
                                <div>
                                    <span class="text-blue-600">Asientos disponibles: </span>
                                    <span class="text-blue-900 font-semibold">{{ $vuelo->asientos_disponibles }}</span>
                                </div>
                                <div>
                                    <span class="text-blue-600">Total para {{ $pasajeros }} {{ $pasajeros == 1 ? 'pasajero' : 'pasajeros' }}: </span>
                                    <span class="text-blue-900 font-bold">${{ number_format(($vueloIda->precio + $vuelo->precio) * $pasajeros, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </button>
                    </form>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Boton de cancelar -->
        <div class="mt-6 flex justify-start">
            <a href="{{ route('vuelos.index') }}" class="px-8 py-4 border-2 border-blue-900 text-blue-900 font-semibold rounded-xl hover:bg-blue-50 transition-all duration-200">
                Volver a buscar
            </a>
        </div>

    </div>
</div>

@endsection
