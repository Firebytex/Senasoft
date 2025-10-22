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
                <button>Solo ida</button>
                <button>Ida y vuelta</button>
            </div>
            <div>
                <input type="search" id="origen" name="origen">
                <ol id="lista1">
                    <li value=""></li>
                </ol>
            
                <input type="search" id="destino" name="destino">
                <ol id="lista2">
                    <li value=""></li>
                </ol>
                
            </div>
            <div>
                <input type="date"><input type="date">
            </div>
            <div>
                <input type="numeric" >
            </div>
        </section>
    </main>
 <script src="{{ asset("js/buscar.js") }}"></script>   
</body>

</html>
    

@endsection

