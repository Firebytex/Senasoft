<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vuelo;
use App\Models\Ciudad;

class VueloController extends Controller
{
    /**
     * Buscar vuelos disponibles
     */
    public function buscar(Request $request)
    {
        $request->validate([
            'origen' => 'required|exists:ciudades,id',
            'destino' => 'required|exists:ciudades,id',
            'fecha_ida' => 'required|date',
            'fecha_regreso' => 'nullable|date|after:fecha_ida',
            'pasajeros' => 'required|integer|min:1|max:5'
        ]);

        // Buscar vuelos de ida
        $vuelosIda = Vuelo::with(['ciudadOrigen', 'ciudadDestino', 'modeloAvion'])
            ->where('ciudad_origen_id', $request->origen)
            ->where('ciudad_destino_id', $request->destino)
            ->where('fecha', $request->fecha_ida)
            ->where('asientos_disponibles', '>=', $request->pasajeros)
            ->orderBy('hora')
            ->get();

        // Buscar vuelos de regreso si aplica
        $vuelosRegreso = null;
        if ($request->fecha_regreso) {
            $vuelosRegreso = Vuelo::with(['ciudadOrigen', 'ciudadDestino', 'modeloAvion'])
                ->where('ciudad_origen_id', $request->destino)
                ->where('ciudad_destino_id', $request->origen)
                ->where('fecha', $request->fecha_regreso)
                ->where('asientos_disponibles', '>=', $request->pasajeros)
                ->orderBy('hora')
                ->get();
        }

        $ciudadOrigen = Ciudad::find($request->origen);
        $ciudadDestino = Ciudad::find($request->destino);

        return view('vuelos.resultados', compact(
            'vuelosIda',
            'vuelosRegreso',
            'ciudadOrigen',
            'ciudadDestino',
            'request'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
