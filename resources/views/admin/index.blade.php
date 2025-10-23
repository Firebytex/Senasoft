@extends('layouts.template')

@section('content')
    <div class="min-h-screen bg-neutral-100 py-8 px-4">
        <div class="max-w-6xl mx-auto">




            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span
                        class="text-transparent bg-clip-text bg-gradient-to-r to-blue-600 from-blue-400">Bienvenido
                        Administrador</span></h1>
            </div>

            <main id="ppal" class="bg-white border border-blue-200 rounded-2xl p-10 shadow-sm">

                <form action="{{ route('vuelos.buscar') }}" method="POST" class="space-y-10">


                    <!-- Crear vuelo -->
                    <div class="pt-4">

                        <a href="{{ route('admin.create') }}"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg">
                            Crear un vuelo
                        </a>

                       

                    </div>

                </form>
            </main>




            <div class="relative overflow-x-auto py-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-blue-200 dark:bg-gray-700 dark:text-gray-400">

                        <tr>
                            <th scope="col" class="px-6 py-3">
                                id vuelo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ciudad_origen_id
                            </th>

                            <th scope="col" class="px-6 py-3">
                                ciudad_destino_id
                            </th>

                            <th scope="col" class="px-6 py-3">
                                modelo_avion_id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                fecha
                            </th>
                            <th scope="col" class="px-6 py-3">
                                hora
                            </th>

                            <th scope="col" class="px-6 py-3">
                                precio
                            </th>

                            <th scope="col" class="px-6 py-3">
                                asientos_disponibles
                            </th>
                        </tr>

                    </thead>
                    <tbody>

                        @foreach ($vuelos as $vuelo)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $vuelo->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $vuelo->ciudad_origen_id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $vuelo->ciudad_destino_id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $vuelo->modelo_avion_id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $vuelo->fecha }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $vuelo->hora }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $vuelo->precio }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $vuelo->asientos_disponibles }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- paginador --}}

                <div class="py-4">
                    {{ $vuelos->links() }}
                </div>

            </div>

        @endsection
