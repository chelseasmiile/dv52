<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('contacto.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mensajevar = new Mensaje();
        return view ('contacto.create',compact('mensajevar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        if (Mensaje::create($request->all())) {
            
        }else
        {
           
        }
        return redirect()->route('inicio');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mensaje $mensaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mensaje $mensaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mensaje $mensaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mensaje $mensaje)
    {
        //
    }
}
