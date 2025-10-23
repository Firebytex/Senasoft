@extends('layouts.template')

@section('content')
{{-- presentacion  --}}
<body class="h-screen w-full flex items-center justify-center flex-col">
    <main class="w-[clamp(210px,83%,700px)] bg-gray-200 rounded-md p-4">
        <section>
        <h2 class="text-[18px] font-light text-blue-900">Informacion del cliente</h2>
        <div class="flex justify-between py-2">
            <p class="text-[14px]">Comprador</p>
            <p></p>
            <p class="text-[14px]">Metodo de pago</p>       
        </div>
        <div class="flex justify-between">
            <p class="text-[12px] text-blue-900">{{ $reserva->pagador_nombre }}</p>
            <p></p>
            <p class="text-[12px] text-blue-900">{{ $reserva->metodo_pago}}</p>
        </div>
        </section>
        <section>
            <h2 class="py-3 text-blue-900 font-light">Detalles de vuelo</h2>
            <h3 class="pb-3 font-bold ">Ida</h3>
            <div class="flex justify-between py-2">
                <p class="text-[14px]">Origen</p>
                <p></p>
                <p class="text-[14px]">Destino</p>
            </div>
            <div class="flex justify-between pb-3">
                <p class="text-[12px] text-blue-900">{{ $reserva->vuelo_ida_id }}</p>
                <p></p>
                <p class="text-[12px] text-blue-900">{{ $reserva->vuelo_regreso_id }}</p>
            </div>
            <div class="flex justify-end">
                <p class="text-[14px]"><span><b>Fecha de emisión: </b></span>{{ $reserva->created_at }}</p>
            </div>
        </section>
        
        <section class="flex justify-between mt-7 bg-black text-white text-[16px] rounded-sm py-3 px-3">
            <p>Total a pagar</p>
            <p></p>
            <p>{{ $reserva->valor_total }}</p>
        </section>
</main>

    
</body>
@endsection