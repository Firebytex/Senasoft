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
        <section>
            <div>
                <button type="button" onclick="habilitar()" class="border border-amber-300" >Solo ida</button>
                <button type="button" onclick="deshabilitar()" class="border border-amber-300">Ida y vuelta</button>
            </div>
            <div>
                <input type="search" id="origen" name="origen" placeholder="Origen">
                <ol id="lista1">
                    <li value=""></li>
                </ol>
            
                <input type="search" id="destino" name="destino" placeholder="Destino">
                <ol id="lista2">
                    <li value=""></li>
                </ol>
                
            </div>
            <div>
                <input type="date" id="fecha_ida" placeholder="Fecha ida">
                <input type="date" id="fecha_regreso" placeholder="Fecha regreso" disabled>
            </div>
            <div>
                <input type="numeric">
            </div>
        </section>
    </main>
 <script src="{{ asset("js/buscar.js") }}"></script>   
</body>

</html>
    

@endsection

