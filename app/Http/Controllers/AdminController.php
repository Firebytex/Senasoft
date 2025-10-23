<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vuelo;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    //mostrar todos los vuelos 
    public function index()
    {   //paginar con ayudar del provider
        $vuelos = Vuelo::paginate(10);

        return view('admin.index',compact('vuelos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.create');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'modelo_avion' => 'required|string|max:255',
            'fecha_vuelo' => 'required|date',
            'precio_por_pasajero' => 'required|numeric',
            'filas' => 'required|numeric',
            'columnas' => 'required|numeric'
        ]);


        Vuelo::create($request->all());


        return redirect()->route('admin.index')
            ->with('success',"Vuelo creado correctamente");


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
