<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Principal;

class PrincipalController extends Controller
{
    public function index()
    {
        $sliders = Principal::all();
        return view('principal.index', compact('sliders'));
    }

    public function create()
    {
        return view('principal.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->except('_token');

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('imagenes_sliders', 'public');
            $requestData['imagen'] = $imagePath;
        }

        Principal::create($requestData);

        return redirect()->route('principal.index')->with('success', 'Slider creado exitosamente.');
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
