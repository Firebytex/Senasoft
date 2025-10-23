@extends('layouts.template')

@section('content')

<div class="min-h-screen bg-neutral-100 py-16 px-4">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-900 mb-2">Completar Reserva</h1>
            <p class="text-blue-600">Ingresa los datos de los pasajeros y el metodo de pago</p>
        </div>

        <!-- Resumen de vuelos -->
        <div class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6 mb-8">
            <h2 class="text-xl font-bold text-blue-900 mb-4">Resumen de Vuelos</h2>

            <!-- Vuelo de Ida -->
            <div class="mb-4">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                    <h3 class="font-semibold text-blue-900">Vuelo de Ida</h3>
                </div>
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

            <!-- Vuelo de Regreso (si existe) -->
            @if($vueloRegreso)
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <h3 class="font-semibold text-blue-900">Vuelo de Regreso</h3>
                </div>
                <div class="grid md:grid-cols-4 gap-4 bg-blue-50 p-4 rounded-lg">
                    <div>
                        <p class="text-sm text-blue-600">Origen</p>
                        <p class="font-semibold text-blue-900">{{ $vueloRegreso->ciudadOrigen->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-600">Destino</p>
                        <p class="font-semibold text-blue-900">{{ $vueloRegreso->ciudadDestino->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-600">Fecha y Hora</p>
                        <p class="font-semibold text-blue-900">{{ \Carbon\Carbon::parse($vueloRegreso->fecha)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($vueloRegreso->hora)->format('H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-600">Precio</p>
                        <p class="font-semibold text-blue-900">${{ number_format($vueloRegreso->precio, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Total -->
            <div class="mt-6 pt-4 border-t border-blue-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-600">Total para {{ $pasajeros }} {{ $pasajeros == 1 ? 'pasajero' : 'pasajeros' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-900">
                            ${{ number_format(($vueloIda->precio + ($vueloRegreso ? $vueloRegreso->precio : 0)) * $pasajeros, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de reserva -->
        <form action="{{ route('reservas.store') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="vuelo_ida_id" value="{{ $vueloIda->id }}">
            @if($vueloRegreso)
                <input type="hidden" name="vuelo_regreso_id" value="{{ $vueloRegreso->id }}">
            @endif

            

            <!-- Datos de los Pasajeros -->
            <div class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-6">Datos de los Pasajeros</h2>

                <div id="pasajeros-container" class="space-y-8">
                    @for($i = 0; $i < $pasajeros; $i++)
                    <div class="pasajero-form border-2 border-blue-200 rounded-lg p-6 {{ $i > 0 ? 'mt-6' : '' }}">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Pasajero {{ $i + 1 }}
                        </h3>

                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Primer Apellido</label>
                                <input type="text" name="pasajeros[{{ $i }}][primer_apellido]" value="{{ old('pasajeros.'.$i.'.primer_apellido') }}" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                @error('pasajeros.'.$i.'.primer_apellido')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Segundo Apellido</label>
                                <input type="text" name="pasajeros[{{ $i }}][segundo_apellido]" value="{{ old('pasajeros.'.$i.'.segundo_apellido') }}" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                @error('pasajeros.'.$i.'.segundo_apellido')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Nombres</label>
                                <input type="text" name="pasajeros[{{ $i }}][nombres]" value="{{ old('pasajeros.'.$i.'.nombres') }}" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                @error('pasajeros.'.$i.'.nombres')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Fecha de Nacimiento</label>
                                <input type="date" name="pasajeros[{{ $i }}][fecha_nacimiento]" value="{{ old('pasajeros.'.$i.'.fecha_nacimiento') }}" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                @error('pasajeros.'.$i.'.fecha_nacimiento')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Genero</label>
                                <select name="pasajeros[{{ $i }}][genero]" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                    <option value="">Seleccionar</option>
                                    <option value="Masculino" {{ old('pasajeros.'.$i.'.genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('pasajeros.'.$i.'.genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('pasajeros.'.$i.'.genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                                @error('pasajeros.'.$i.'.genero')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Tipo de Documento</label>
                                <select name="pasajeros[{{ $i }}][tipo_documento]" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                    <option value="">Seleccionar</option>
                                    <option value="CC" {{ old('pasajeros.'.$i.'.tipo_documento') == 'CC' ? 'selected' : '' }}>Cedula de Ciudadania</option>
                                    <option value="TI" {{ old('pasajeros.'.$i.'.tipo_documento') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                                    <option value="CE" {{ old('pasajeros.'.$i.'.tipo_documento') == 'CE' ? 'selected' : '' }}>Cedula de Extranjeria</option>
                                    <option value="PA" {{ old('pasajeros.'.$i.'.tipo_documento') == 'PA' ? 'selected' : '' }}>Pasaporte</option>
                                </select>
                                @error('pasajeros.'.$i.'.tipo_documento')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Numero de Documento</label>
                                <input type="text" name="pasajeros[{{ $i }}][numero_documento]" value="{{ old('pasajeros.'.$i.'.numero_documento') }}" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                @error('pasajeros.'.$i.'.numero_documento')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Celular</label>
                                <input type="tel" name="pasajeros[{{ $i }}][celular]" value="{{ old('pasajeros.'.$i.'.celular') }}" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                @error('pasajeros.'.$i.'.celular')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-blue-900 mb-2">Correo Electronico</label>
                                <input type="email" name="pasajeros[{{ $i }}][correo]" value="{{ old('pasajeros.'.$i.'.correo') }}" required
                                    class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                                @error('pasajeros.'.$i.'.correo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="pasajeros[{{ $i }}][es_infante]" value="1" {{ old('pasajeros.'.$i.'.es_infante') ? 'checked' : '' }}
                                        class="w-5 h-5 text-blue-600 border-2 border-blue-300 rounded focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-blue-900">Es infante (menor de 2 anos)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>



            <!-- Metodo de Pago -->
            <div class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-6">Metodo de Pago</h2>

                <div class="grid md:grid-cols-3 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="metodo_pago" value="tarjeta_credito" {{ old('metodo_pago') == 'tarjeta_credito' ? 'checked' : '' }} required class="peer sr-only">
                        <div class="border-2 border-blue-200 rounded-lg p-4 peer-checked:border-blue-600 peer-checked:bg-blue-50 transition-all duration-200 hover:border-blue-400">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                <span class="font-semibold text-blue-900">Tarjeta de Credito</span>
                            </div>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="metodo_pago" value="tarjeta_debito" {{ old('metodo_pago') == 'tarjeta_debito' ? 'checked' : '' }} required class="peer sr-only">
                        <div class="border-2 border-blue-200 rounded-lg p-4 peer-checked:border-blue-600 peer-checked:bg-blue-50 transition-all duration-200 hover:border-blue-400">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                <span class="font-semibold text-blue-900">Tarjeta de Debito</span>
                            </div>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="metodo_pago" value="pse" {{ old('metodo_pago') == 'pse' ? 'checked' : '' }} required class="peer sr-only">
                        <div class="border-2 border-blue-200 rounded-lg p-4 peer-checked:border-blue-600 peer-checked:bg-blue-50 transition-all duration-200 hover:border-blue-400">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold text-blue-900">PSE</span>
                            </div>
                        </div>
                    </label>
                </div>
                @error('metodo_pago')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>



            <!-- Datos del Pagador -->
            <div class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-6">Datos del Pagador</h2>

                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Nombre Completo</label>
                        <input type="text" name="pagador_nombre" value="{{ old('pagador_nombre') }}" required
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                        @error('pagador_nombre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Correo Electronico</label>
                        <input type="email" name="pagador_correo" value="{{ old('pagador_correo') }}" required
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                        @error('pagador_correo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Telefono</label>
                        <input type="tel" name="pagador_telefono" value="{{ old('pagador_telefono') }}" required
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-600 transition-colors duration-200">
                        @error('pagador_telefono')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>


            

            <!-- Botones de accion -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('vuelos.index') }}"
                    class="px-8 py-4 border-2 border-blue-900 text-blue-900 font-semibold rounded-xl hover:bg-blue-50 transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-8 py-4 bg-blue-900 text-white font-semibold rounded-xl hover:bg-blue-800 active:bg-blue-950 transition-all duration-200 shadow-md hover:shadow-lg">
                    Confirmar Reserva
                </button>
            </div>
        </form>

    </div>
</div>

@endsection
