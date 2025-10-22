<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Vuelo;
use App\Models\Pasajero;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function seleccionar(Request $request)
    {
        $vueloIda = Vuelo::with(['ciudadOrigen', 'ciudadDestino', 'modeloAvion'])
            ->findOrFail($request->vuelo_ida_id);

        $vueloRegreso = null;
        $vuelosRegreso = [];

        // Si requiere regreso, buscar vuelos de regreso
        if ($request->requiere_regreso) {
            $vuelosRegreso = Vuelo::with(['ciudadOrigen', 'ciudadDestino', 'modeloAvion'])
                ->where('ciudad_origen_id', $request->destino_id)
                ->where('ciudad_destino_id', $request->origen_id)
                ->where('fecha', $request->fecha_regreso)
                ->where('asientos_disponibles', '>=', $request->pasajeros)
                ->orderBy('hora')
                ->get();

            if ($request->vuelo_regreso_id) {
                $vueloRegreso = Vuelo::findOrFail($request->vuelo_regreso_id);
            }
        }

        $pasajeros = $request->pasajeros;

        // Si ya se seleccionaron ambos vuelos o solo ida, ir al formulario de reserva
        if ($vueloRegreso || !$request->requiere_regreso) {
            return view('reservas.formulario', compact('vueloIda', 'vueloRegreso', 'pasajeros'));
        }

        // Mostrar opciones de vuelo de regreso
        return view('reservas.seleccionar_regreso', compact('vueloIda', 'vuelosRegreso', 'pasajeros', 'request'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vuelo_ida_id' => 'required|exists:vuelos,id',
            'vuelo_regreso_id' => 'nullable|exists:vuelos,id',
            'pagador_nombre' => 'required|string|max:255',
            'pagador_correo' => 'required|email|max:255',
            'pagador_telefono' => 'required|string|max:20',
            'metodo_pago' => 'required|string',
            'pasajeros' => 'required|array|min:1|max:5',
            'pasajeros.*.primer_apellido' => 'required|string|max:255',
            'pasajeros.*.segundo_apellido' => 'required|string|max:255',
            'pasajeros.*.nombres' => 'required|string|max:255',
            'pasajeros.*.fecha_nacimiento' => 'required|date',
            'pasajeros.*.genero' => 'required|in:Masculino,Femenino,Otro',
            'pasajeros.*.tipo_documento' => 'required|string',
            'pasajeros.*.numero_documento' => 'required|string|max:20',
            'pasajeros.*.es_infante' => 'nullable|boolean',
            'pasajeros.*.celular' => 'required|string|max:20',
            'pasajeros.*.correo' => 'required|email|max:255',
        ]);

        DB::beginTransaction();

        try {
            $vueloIda = Vuelo::findOrFail($request->vuelo_ida_id);
            $vueloRegreso = $request->vuelo_regreso_id ? Vuelo::findOrFail($request->vuelo_regreso_id) : null;

            // Calcular valor total
            $numPasajeros = count($request->pasajeros);
            $valorTotal = $vueloIda->precio * $numPasajeros;
            if ($vueloRegreso) {
                $valorTotal += $vueloRegreso->precio * $numPasajeros;
            }

            // Crear reserva
            $reserva = Reserva::create([
                'vuelo_ida_id' => $vueloIda->id,
                'vuelo_regreso_id' => $vueloRegreso?->id,
                'pagador_nombre' => $request->pagador_nombre,
                'pagador_correo' => $request->pagador_correo,
                'pagador_telefono' => $request->pagador_telefono,
                'metodo_pago' => $request->metodo_pago,
                'valor_total' => $valorTotal,
            ]);

            // Crear pasajeros y asociarlos a la reserva
            foreach ($request->pasajeros as $pasajeroData) {
                $pasajero = Pasajero::create([
                    'primer_apellido' => $pasajeroData['primer_apellido'],
                    'segundo_apellido' => $pasajeroData['segundo_apellido'],
                    'nombres' => $pasajeroData['nombres'],
                    'fecha_nacimiento' => $pasajeroData['fecha_nacimiento'],
                    'genero' => $pasajeroData['genero'],
                    'tipo_documento' => $pasajeroData['tipo_documento'],
                    'numero_documento' => $pasajeroData['numero_documento'],
                    'es_infante' => isset($pasajeroData['es_infante']) ? true : false,
                    'celular' => $pasajeroData['celular'],
                    'correo' => $pasajeroData['correo'],
                ]);

                $reserva->pasajeros()->attach($pasajero->id);
            }

            // Actualizar asientos disponibles
            $vueloIda->decrement('asientos_disponibles', $numPasajeros);
            if ($vueloRegreso) {
                $vueloRegreso->decrement('asientos_disponibles', $numPasajeros);
            }

            DB::commit();

            return redirect()->route('reservas.confirmacion', $reserva->id)
                ->with('success', 'Reserva creada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear la reserva: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function confirmacion($id)
    {
        $reserva = Reserva::with(['vueloIdda.ciudadOrigen', 'vueloIdda.ciudadDestino',
                                  'vueloRegreso.ciudadOrigen', 'vueloRegreso.ciudadDestino',
                                  'pasajeros'])
            ->findOrFail($id);

        return view('reservas.confirmacion', compact('reserva'));
    }
}
