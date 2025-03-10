<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredientes_extra;

class Ingrediente_ExtraController extends Controller
{
    //Mostrar todos los ingredientes extra
    public function index()
    {
        $extras = Ingredientes_extra::all();
        return view('extras.index', ['extras' => $extras]);
    }

    public function updateAll(Request $request)
{
    $datos = $request->all();

    foreach ($datos as $key => $value) {
        // Ignora los campos _token y _method
        if ($key == '_token' || $key == '_method') {
            continue;
        }

        // Divide la clave en el prefijo y el ID
        list($prefix, $id) = explode('_', $key);

        // Convierte $id a un número entero
        $id = (int) $id;

        $extra = Ingredientes_extra::find($id);

        if ($extra) {
            if ($prefix == 'coste') {
                $extra->coste_extra = $value;
            } elseif ($prefix == 'cantidad') {
                $extra->cantidad = $value;
            }

            $extra->save();
        }
    }

    // Redirige al usuario a la página anterior con un mensaje de éxito
    return redirect()->back()->with('success', 'Las cantidades y costes de todos los ingredientes han sido actualizadas.');
}

    //Ir al formulario de creacion
    public function create(){
        return view("extras.create");
    }

    //Crear un nuevo ingrediente
    public function store(Request $request){
        $extra = new Ingredientes_extra();
        $extra->nombre = $request->nombre;
        $extra->coste_extra = $request->coste_extra;
        $extra->cantidad = $request->cantidad;
        $extra->save();
        return redirect()->route("extras.edit", $extra);

    }

    //Ir a los detalles de un ingrediente
    public function show(Ingredientes_extra $extra){
        return view("extras.show", compact('extra'));
    }

    //Ir al formulario de edición
    public function edit(Ingredientes_extra $extra){
        return view("extras.edit", compact('extra'));
    }

    //Modificar un ingrediente
    public function update(Request $request, Ingredientes_extra $extra){
        $extra->nombre = $request->nombre;
        $extra->coste_extra = $request->coste_extra;
        $extra->cantidad = $request->cantidad;
        $extra->save();
        return redirect()->route("extras.index");
    }

    //Eliminar un ingrediente
    public function destroy(Ingredientes_extra $extra){
        $extra->delete();
        return redirect()->route("extras.index");
    }
}
