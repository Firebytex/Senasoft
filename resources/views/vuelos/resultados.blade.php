@extends('layouts.template')

@section('content')

<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4">
    <div class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('ciudades.lista') }}" class="inline-flex items-center text-blue-900 hover:text-blue-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Nueva búsqueda
            </a>
            <h1 class="text-3xl font-light text-blue-900 mb-2">Resultados de búsqueda</h1>
            <p class="text-blue-700">
                {{ $ciudadOrigen->nombre }} → {{ $ciudadDestino->nombre }}
                | {{ $request->pasajeros }} {{ $request->pasajeros == 1 ? 'pasajero' : 'pasajeros' }}
            </p>
        </div>

        <!-- Vuelos de Ida -->
        <div class="mb-10">
            <h2 class="text-2xl font-medium text-blue-900 mb-6 border-b-2 border-blue-900 pb-2">
                Vuelos de Ida - {{ \Carbon\Carbon::parse($request->fecha_ida)->format('d/m/Y') }}
            </h2>

            @if($vuelosIda->count() > 0)
                <div class="space-y-4">
                    @foreach($vuelosIda as $vuelo)
                        <div class="bg-white border-2 border-blue-200 rounded-xl p-6 hover:border-blue-400 transition-colors duration-200">
                            <div class="grid md:grid-cols-5 gap-4 items-center">
                                <!-- Horario -->
                                <div class="md:col-span-2">
                                    <div class="flex items-center gap-4">
                                        <div class="text-center">
                                            <p class="text-2xl font-bold text-blue-900">{{ \Carbon\Carbon::parse($vuelo->hora)->format('H:i') }}</p>
                                            <p class="text-sm text-blue-600">{{ $vuelo->ciudadOrigen->codigo }}</p>
                                        </div>
                                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                        <div class="text-center">
                                            <p class="text-sm text-blue-600">{{ $vuelo->ciudadDestino->codigo }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detalles del vuelo -->
                                <div>
                                    <p class="text-sm text-blue-700 font-medium">{{ $vuelo->modeloAvion->nombre }}</p>
                                    <p class="text-xs text-blue-500">{{ $vuelo->asientos_disponibles }} asientos disponibles</p>
                                </div>

                                <!-- Precio -->
                                <div class="text-center">
                                    <p class="text-xs text-blue-600 mb-1">Precio por persona</p>
                                    <p class="text-2xl font-bold text-blue-900">${{ number_format($vuelo->precio, 0, ',', '.') }}</p>
                                </div>

                                <!-- Botón -->
                                <div>
                                    <form action="{{ route('reservas.seleccionar') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="vuelo_ida_id" value="{{ $vuelo->id }}">
                                        <input type="hidden" name="pasajeros" value="{{ $request->pasajeros }}">
                                        @if($request->fecha_regreso)
                                            <input type="hidden" name="requiere_regreso" value="1">
                                            <input type="hidden" name="fecha_regreso" value="{{ $request->fecha_regreso }}">
                                            <input type="hidden" name="origen_id" value="{{ $request->origen }}">
                                            <input type="hidden" name="destino_id" value="{{ $request->destino }}">
                                        @endif
                                        <button type="submit" class="w-full bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition-colors duration-200 font-medium">
                                            {{ $request->fecha_regreso ? 'Continuar' : 'Reservar' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white border-2 border-blue-200 rounded-xl p-8 text-center">
                    <svg class="w-16 h-16 mx-auto text-blue-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-blue-700 text-lg">No se encontraron vuelos para la fecha seleccionada</p>
                    <p class="text-blue-500 mt-2">Intenta con otra fecha u otra ciudad</p>
                </div>
            @endif
        </div>

        <!-- Vuelos de Regreso -->
        @if($vuelosRegreso !== null)
            <div class="mb-10">
                <h2 class="text-2xl font-medium text-blue-900 mb-6 border-b-2 border-blue-900 pb-2">
                    Vuelos de Regreso - {{ \Carbon\Carbon::parse($request->fecha_regreso)->format('d/m/Y') }}
                </h2>

                @if($vuelosRegreso->count() > 0)
                    <div class="space-y-4">
                        @foreach($vuelosRegreso as $vuelo)
                            <div class="bg-white border-2 border-blue-200 rounded-xl p-6 hover:border-blue-400 transition-colors duration-200">
                                <div class="grid md:grid-cols-5 gap-4 items-center">
                                    <!-- Horario -->
                                    <div class="md:col-span-2">
                                        <div class="flex items-center gap-4">
                                            <div class="text-center">
                                                <p class="text-2xl font-bold text-blue-900">{{ \Carbon\Carbon::parse($vuelo->hora)->format('H:i') }}</p>
                                                <p class="text-sm text-blue-600">{{ $vuelo->ciudadOrigen->codigo }}</p>
                                            </div>
                                            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                            <div class="text-center">
                                                <p class="text-sm text-blue-600">{{ $vuelo->ciudadDestino->codigo }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Detalles del vuelo -->
                                    <div>
                                        <p class="text-sm text-blue-700 font-medium">{{ $vuelo->modeloAvion->nombre }}</p>
                                        <p class="text-xs text-blue-500">{{ $vuelo->asientos_disponibles }} asientos disponibles</p>
                                    </div>

                                    <!-- Precio -->
                                    <div class="text-center">
                                        <p class="text-xs text-blue-600 mb-1">Precio por persona</p>
                                        <p class="text-2xl font-bold text-blue-900">${{ number_format($vuelo->precio, 0, ',', '.') }}</p>
                                    </div>

                                    <!-- Botón -->
                                    <div>
                                        <button class="w-full bg-blue-300 text-white px-6 py-3 rounded-lg cursor-not-allowed" disabled>
                                            Seleccione ida primero
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white border-2 border-blue-200 rounded-xl p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-blue-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-blue-700 text-lg">No se encontraron vuelos de regreso para la fecha seleccionada</p>
                    </div>
                @endif
            </div>
        @endif

    </div>
</div>

@endsection
