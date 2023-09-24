<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Principal;
use Illuminate\Support\Facades\Log;

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
        try {
            $data = $request->validate([
                'slider1' => 'required',
                'imagen_s1' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
    
            $imagens1 = $request->file('imagen_s1')->store('quienessomos_imagenes/s1', 'public');
    
            $collection = new Principal($data);
            $collection->imagen_s1 = $imagens1;
            $collection->save();
    
            return redirect()->route('principal.index')->with('success', 'Slider creado exitosamente.');
        } catch (\Exception $e) {
            // Maneja la excepción de la forma que prefieras
            // Por ejemplo, registra el error en un log y muestra un mensaje de error
           // abort(500, 'No se recibió un código de autenticación.'); 
            Log::error($e->getMessage());
            return redirect()->route('principal.create')->with('error', 'No se pudo guardar la información, verifique que esta introduciendo una imagen compatible.');
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $collection = Principal::findOrFail($id);
        //dd($collection); // Debugging line
        return view('principal.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */

     
    public function update(Request $request, $id)
    {
        try {
            // Valida los datos del formulario
            $data = $request->validate([
                'slider1' => 'required',
                'imagen_s1' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
    
            // Busca el registro en la base de datos
            $collection = Principal::findOrFail($id);
    
            // Actualiza los campos del modelo con los datos validados
            $collection->update($data);
    
            // Sube la nueva imagen si se ha proporcionado
            if ($request->hasFile('imagen_s1')) {
                $imagenS1 = $request->file('imagen_s1')->store('slider_imagenes', 'public');
                $collection->imagen_s1 = $imagenS1;
                $collection->save();
            }
    
            return redirect()->route('principal.index')->with('success', 'Slider actualizada exitosamente.');
        } catch (\Exception $e) {
            // Maneja la excepción de la forma que prefieras
            // Por ejemplo, registra el error en un log y muestra un mensaje de error
            Log::error($e->getMessage());
            return redirect()->route('principal.edit', $id)->with('error', 'No se pudo guardar la información, verifique que esta introduciendo una imagen compatible.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // dd('destroy method');
        $collection = Principal::findOrFail($id);
        $collection->delete();

        return redirect()->route('principal.index')->with('success', 'Slider eliminada exitosamente.');
    }

    public function show(string $id)
    {
        $collection = Principal::findOrFail($id);
        dd($collection); // Debugging line
        return view('principal.show', compact('collection'));
    }



}
