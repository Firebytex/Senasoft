@extends('layouts.template')

@section('content')

    <h1>Prueba vista</h1>



    <table>
        <tr>
            <th>Vuelo ida origen</th>
            <th>Vuelo destino</th>
            <th>Vuelo regreso</th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>{{ $reserva->vuelo_ida_id }}</td>
            <td>{{ $reserva->vuelo_regreso_id }}</td>
            <td>{{ $reserva->pagador_nombre }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>
@endsection