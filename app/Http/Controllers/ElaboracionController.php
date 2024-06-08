<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElaboracionRequest;
use App\Models\Ingrediente;
use App\Models\Bocadillo;
use App\Models\Elaboracion;
use App\Models\Tipo;

class ElaboracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $p = Bocadillo::all();
        $productos = [];
        foreach ($p as $pr){
            $productos[$pr->id] = $pr->nombre;
        }
        $i = Ingrediente::all();
        $ingredientes = [];
        foreach ($i as $ig){
            $ingredientes[$ig->id] = $ig->nombre;
        }
        $elaboraciones = Elaboracion::all();
        return view('elaboraciones.index', compact('productos', 'ingredientes', 'elaboraciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Tipo::all();
        $ingredientes = Ingrediente::all();
        return view('elaboraciones.create', compact('productos', 'ingredientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ElaboracionRequest $request)
    {
        $e = new Elaboracion();
        $e->bocadillo_id = $request->bocadillo_id;
        $e->ingrediente_id = $request->ingrediente_id;
        $e->cantidad = $request->cantidad;
        $e->save();
        return redirect()->route('elaboracion.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Elaboracion $elaboracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Elaboracion $elaboracion)
    {
        $productos = Bocadillo::all();
        $ingredientes = Ingrediente::all();
        return view('elaboraciones.edit', compact('productos', 'ingredientes', 'elaboracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ElaboracionRequest $request, Elaboracion $elaboracion)
    {
        $elaboracion->bocadillo_id = $request->bocadillo_id;
        $elaboracion->ingrediente_id = $request->ingrediente_id;
        $elaboracion->cantidad = $request->cantidad;
        $elaboracion->save();
        return redirect()->route('elaboracion.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Elaboracion $elaboracion)
    {
        $elaboracion->delete();
        return redirect()->route('elaboracion.index');
    }
}
