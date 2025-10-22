@extends('layouts.template')

@section('content')

<div class="min-h-screen bg-neutral-100 py-16 px-4">
    <div class="max-w-5xl mx-auto">

        <div class="container mx-auto p-4">
                <img src="{{ asset('logos/SenaAir.png') }}" alt="Descripción de la imagen" class="w-40 h-auto mx-auto rounded-lg">
        </div>


            
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-blue-600 from-blue-400">Sena Air</span></h1>
        </div>

        <main id="ppal" class="bg-white border border-blue-200 rounded-2xl p-10 shadow-sm">

            <form action="{{ route('vuelos.buscar') }}" method="POST" class="space-y-10">
                @csrf
                <div class="flex gap-4 justify-center pb-6 border-b border-blue-100">
                    <button type="button" id="ida"
                        class="px-10 py-3.5 border-2 border-blue-900 text-blue-900 font-medium rounded-xl hover:bg-blue-900 hover:text-white transition-all duration-200 min-w-[160px] hover:cursor-pointer">
                        Solo ida
                    </button>
                    <button type="button" id="ida_vuelta"
                        class="px-10 py-3.5 border-2 border-blue-900 text-blue-900 font-medium rounded-xl hover:bg-blue-900 hover:text-white transition-all duration-200 min-w-[160px] hover:cursor-pointer">
                        Ida y vuelta
                    </button>
                </div>

                <!-- Origen y Destino -->
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Origen -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-blue-900 mb-3 uppercase tracking-wide text-xs">Origen</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <input type="search" id="origen" placeholder="Ciudad de origen" autocomplete="off"
                                class="w-full pl-12 pr-4 py-4 border-2 border-blue-200 rounded-xl focus:outline-none focus:border-blue-600 text-blue-900 placeholder-blue-400 font-medium transition-colors duration-200" value="{{old('origen', $Ciudad->nombre ?? '')}}">
                            <input type="hidden" id="origen_id" name="origen" required>
                        </div>
                        <ol id="lista1" class="absolute w-full mt-2 bg-white border-2 border-blue-300 rounded-xl max-h-64 overflow-y-auto hidden z-20 shadow-lg">
                            @foreach ($lugares as $lugar)
                                <li value="{{ $lugar->id }}" class="px-5 py-3.5 hover:bg-blue-50 cursor-pointer text-blue-900 border-b border-blue-100 last:border-b-0 transition-colors duration-150 font-medium">
                                    {{ $lugar->nombre }}
                                </li>
                            @endforeach
                        </ol>
                    </div>

                    <!-- Destino -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-blue-900 mb-3 uppercase tracking-wide text-xs">Destino</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <input type="search" id="destino" placeholder="Ciudad de destino" autocomplete="off"
                                class="w-full pl-12 pr-4 py-4 border-2 border-blue-200 rounded-xl focus:outline-none focus:border-blue-600 text-blue-900 placeholder-blue-400 font-medium transition-colors duration-200">
                            <input type="hidden" id="destino_id" name="destino" required>
                        </div>
                        <ol id="lista2" class="absolute w-full mt-2 bg-white border-2 border-blue-300 rounded-xl max-h-64 overflow-y-auto hidden z-20 shadow-lg">
                            @foreach ($lugares as $lugar)
                                <li value="{{ $lugar->id }}" class="px-5 py-3.5 hover:bg-blue-50 cursor-pointer text-blue-900 border-b border-blue-100 last:border-b-0 transition-colors duration-150 font-medium">
                                    {{ $lugar->nombre }}
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <!-- Fechas -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-3 uppercase tracking-wide text-xs">Fecha de ida</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <input type="date" id="fecha_ida" name="fecha_ida" min="2025-10-23" max="2025-12-23" required
                                class="w-full pl-12 pr-4 py-4 border-2 border-blue-200 rounded-xl focus:outline-none focus:border-blue-600 text-blue-900 font-medium transition-colors duration-200">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-3 uppercase tracking-wide text-xs">Fecha de regreso</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <input type="date" id="fecha_regreso" name="fecha_regreso" min="2025-10-23" max="2025-12-23" disabled
                                class="w-full pl-12 pr-4 py-4 border-2 border-blue-200 rounded-xl focus:outline-none focus:border-blue-600 text-blue-900 disabled:bg-gray-200 disabled:text-gray-600 disabled:border-blue-100 font-medium transition-colors duration-200">
                        </div>
                    </div>
                </div>

                <!-- Pasajeros -->
                <div class="max-w-xs">
                    <label class="block text-sm font-semibold text-blue-900 mb-3 uppercase tracking-wide text-xs">Pasajeros</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input type="number" id="pasajeros" name="pasajeros" min="1" max="5" value="1" required
                            class="w-full pl-12 pr-4 py-4 border-2 border-blue-200 rounded-xl focus:outline-none focus:border-blue-600 text-blue-900 font-medium transition-colors duration-200">
                    </div>
                </div>

                <!-- Botón de búsqueda -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-900 text-white font-semibold py-5 rounded-xl hover:bg-blue-800 active:bg-blue-950 transition-all duration-200 text-lg tracking-wide uppercase shadow-md hover:shadow-lg">
                        Buscar vuelos
                    </button>
                </div>

            </form>
        </main>

        <!-- Footer info -->
        <div class="mt-8 text-center text-sm text-blue-600">
            <p class="font-light">Encuentra las mejores ofertas para tu próximo viaje</p>
        </div>

    </div>
</div>

<script src="{{ asset("js/buscar.js") }}"></script>

@endsection

