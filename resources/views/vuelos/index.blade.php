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
                <input type="search" id="origen" name="origen" placeholder="Origen">
                <ol id="lista1" class="">
                    @foreach ($lugares as $lugar)
                     <li value="{{ $lugar->id }}" class="" >{{ $lugar -> nombre }}</li>   
                    @endforeach
                    
                </ol>
            
                <input type="search" id="destino" name="destino" placeholder="Destino">
                <ol id="lista2" class="">
                    @foreach ($lugares as $lugar)
                    <li value="{{ $lugar->id }}" class="" >{{ $lugar -> nombre }}</li>   
                     @endforeach
                </ol>
                
            </div>
            <div>
                <input type="date" id="fecha_ida" placeholder="Fecha ida" min="2025-10-23" max="2025-12-23">
                <input type="date" id="fecha_regreso" placeholder="Fecha regreso" min="2025-10-23" max="2025-12-23" disabled>
            </div>
            <div>
                <input type="numeric">
            </div>
            <button >Buscar</button>
        </form>
    </main>
 <script src="{{ asset("js/buscar.js") }}"></script>   
</body>

</html>
    

@endsection

