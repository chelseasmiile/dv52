<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qr;

class QrController extends Controller
{
    public function index()
    {
        $qrs = Qr::all();
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identificador' => 'required|unique:generador_qr',
            'titulo' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            'participantes' => 'required',
            'imagen_qr' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imageName = time() . '.' . $request->imagen_qr->extension();
        $request->imagen_qr->storeAs('imagenes_qr', $imageName, 'public');

        $qr = new Qr();
        $qr->identificador = $validatedData['identificador'];
        $qr->titulo = $validatedData['titulo'];
        $qr->fecha = $validatedData['fecha'];
        $qr->descripcion = $validatedData['descripcion'];
        $qr->participantes = $validatedData['participantes'];
        $qr->imagen_qr = $imageName;
        $qr->save();

        return redirect()->route('qrs.index')->with('success', 'Código QR creado exitosamente.');
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
