<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Principal;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection = Principal::all();
        //dd($collection); // Debugging line
        return view('principal.index', compact('collection'));
    }

    public function create()
    {
        //dd('create method'); // Debugging line
        return view('principal.create');
    }

    public function store(Request $request)
    {
        //dd('store method');
        $data = $request->validate([
            'slider1' => 'required',
            'slider2' => 'required',
            'slider3' => 'required',
            'imagen_s1' => 'required|image|mimes:jpeg,png,jpg,gif',
            'imagen_s2' => 'required|image|mimes:jpeg,png,jpg,gif',
            'imagen_s3' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        //dd('store method');
        $imagens1 = $request->file('imagen_s1')->store('quienessomos_imagenes/s1', 'public');
        $imagens2 = $request->file('imagen_s2')->store('quienessomos_imagenes/s2', 'public');
        $imagens3 = $request->file('imagen_s3')->store('quienessomos_imagenes/s3', 'public');
    
        //dd('store method');
        $collection = new Principal($data);
        $collection->imagen_s1 = $imagens1;
        $collection->imagen_s2 = $imagens2;
        $collection->imagen_s3 = $imagens3;
        $collection->save();
        //dd('store method');
    
        return redirect()->route('principal.index')->with('success', 'Información de Quienes Somos creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $collection = Principal::findOrFail($id);
        dd($collection); // Debugging line
        return view('principal.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        dd('update method'); 
        $data = $request->validate([
        'slider1' => 'required',
        'slider2' => 'required',
        'slider3' => 'required',
        'imagen_s1' => 'required|image|mimes:jpeg,png,jpg,gif',
        'imagen_s2' => 'required|image|mimes:jpeg,png,jpg,gif',
        'imagen_s3' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);

    if ($request->hasFile('imagen_s1')) {
        $imagens1 = $request->file('imagen_s1')->store('slider_imagenes', 'public');
        $data['imagen_s1'] = $imagens1;
    }

    if ($request->hasFile('imagen_s2')) {
        $imagens2 = $request->file('imagen_s2')->store('slider_imagenes', 'public');
        $data['imagen_s2'] = $imagens2;
    }

    if ($request->hasFile('imagen_s3')) {
        $imagens3 = $request->file('imagen_s3')->store('slider_imagenes', 'public');
        $data['imagen_s3'] = $imagens3;
    }

    $collection = Principal::findOrFail($id);


    return redirect()->route('principal.index')->with('success', 'Información de Quienes Somos actualizada exitosamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // dd('destroy method');
        $collection = Principal::findOrFail($id);
        $collection->delete();

        return redirect()->route('principal.index')->with('success', 'Información de Quienes Somos eliminada exitosamente.');
    }

    public function show(string $id)
    {
        $collection = Principal::findOrFail($id);
        dd($collection); // Debugging line
        return view('principal.show', compact('collection'));
    }



}
