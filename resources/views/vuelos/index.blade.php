@extends('layouts.template')


@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <input type="search" id="destino" name="destino">
            </div>
            <div>
                <input type="date"><input type="date">
            </div>
            <div>
                <input type="numeric" >
            </div>
        </section>
    </main>
    
</body>
</html>
    

@endsection

@section('scripts')

@endsection