<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Tipo;
use Illuminate\Support\Facades\Log;

class IngredienteController extends Controller
{
    //Mostrar todos los ingredientes principales
    public function index()
    {
        $ingredientes = Ingrediente::all();
        return view("ingredientes.index", compact('ingredientes'));
    }

    //Ir al formulario de creación
    public function create()
    {
        return view("ingredientes.create");
    }

    //Crear un nuevo ingrediente
    public function store(Request $request)
    {
        $ingrediente = new Ingrediente();
        $ingrediente->nombre = $request->nombre;
        $ingrediente->cantidad = $request->cantidad;
        $ingrediente->save();
        return redirect()->route("ingredientes.index");
    }

    //Ver los detalles de un ingrediente
    public function show(Ingrediente $ingrediente)
    {
        return view("ingredientes.show", compact('ingrediente'));
    }

    //Ir al formulario de edición
    public function edit(Ingrediente $ingrediente)
    {
        return view("ingredientes.edit", compact('ingrediente'));
    }

    //Modificar un ingrediente
    public function update(Request $request, Ingrediente $ingrediente)
    {
        $ingrediente->nombre = $request->nombre;
        $ingrediente->cantidad = $request->cantidad;
        $ingrediente->save();

        $bocadillos = Tipo::all();


        return redirect()->route("ingredientes.editall");
    }

    //Eliminar un ingrediente
    public function destroy(Ingrediente $ingrediente)
    {
        $n = $ingrediente->nombre;
        $ingrediente->delete();
        return redirect()->route("ingredientes.editall");
    }

    public function updateAll(Request $request)
    {

        $datos = $request->all();


        foreach ($datos as $id => $cantidad) {
            // Convierte $id a un número entero
            $id = (int) $id;

            $ingrediente = Ingrediente::find($id);

            if ($ingrediente) {
                $ingrediente->cantidad = $cantidad;
                $ingrediente->save();
            }
        }

        // Redirige al usuario a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'Las cantidades de todos los ingredientes han sido actualizadas.');
    }

    public function editall()
    {
        $ingredientes = Ingrediente::all();
        return view('ingredientes.editall', ['ingredientes' => $ingredientes]);
    }
}
