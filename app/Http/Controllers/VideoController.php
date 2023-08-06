<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('videos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $requestData = $request->except('_token');

    if ($request->hasFile('ruta_video')) {
        $videoPath = $request->file('ruta_video')->store('videos', 'public');
        $requestData['ruta_video'] = $videoPath;
    }

    Video::create($requestData);

    return redirect()->route('videos.index')->with('success', 'Video creado exitosamente.');
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
