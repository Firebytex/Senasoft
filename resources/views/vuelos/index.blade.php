@extends('layouts.template')


@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./jquery-ui/jquery-ui.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
</head>
<body>
    <main id="ppal">
        <figure>
            <img src="" alt="">
        </figure>
        <form>
            <div>
                <button type="button" class="border border-amber-300" id="ida" >Solo ida</button>
                <button type="button" class="border border-amber-300" id="ida_vuelta">Ida y vuelta</button>
            </div>
            <div>
                <input type="search" id="origen" name="origen" placeholder="Origen" required>
                <ol id="lista1" class="">
                    @foreach ($lugares as $lugar)
                     <li value="{{ $lugar->id }}" class="lista1" >{{ $lugar -> nombre }}</li>   
                    @endforeach
                    
                </ol>
            
                <input type="search" id="destino" name="destino" placeholder="Destino" required>
                <ol id="lista2" class="">
                    @foreach ($lugares as $lugar)
                    <li value="{{ $lugar->id }}" class="lista2" >{{ $lugar -> nombre }}</li>   
                     @endforeach
                </ol>
                
            </div>
            <div>
                <input type="date" id="fecha_ida" placeholder="Fecha ida" required>
                <input type="date" id="fecha_regreso" placeholder="Fecha regreso"  disabled>
            </div>
            <div>
                <select required >
                    <option value="">Seleccione la cantidad de pasajeros</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <button id="buscar" >Buscar</button>
        </form>

        <a href="">Buscar mi reserva</a>
    </main>
 <script src="{{ asset("js/buscar.js") }}"></script>   
</body>

</html>
    

@endsection

