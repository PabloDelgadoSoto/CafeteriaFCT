<?php

namespace App\Http\Controllers;

use App\Models\Bocadillo;
use Illuminate\Http\Request;
use App\Models\Tipo;
use App\Models\Ingredientes_extra;

class BocadilloController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function verificarDisponibilidad()
    {
        // Obtén todos los bocadillos
        $bocadillos = Bocadillo::all();

        // Verifica la disponibilidad de cada bocadillo
        foreach ($bocadillos as $bocadillo) {
            $bocadillo->verificarDisponibilidad();
        }

        // Redirige al usuario a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'La disponibilidad de todos los bocadillos ha sido verificada.');
    }

    //Devolver todos los bocadilloss, revisar para meter paginacion
    public function index(){
        $bocadillos = Bocadillo::all();
        return view("bocadillos.index", compact('bocadillos'));
    }

    //Ir al formulario de crear
    public function create(){
        $tipos = Tipo::all();
        return view("bocadillos.create", compact('tipos'));
    }

    //Crear bocadillo nuevo
    public function store(Request $request){
        $imagen = $request->file('imagen');
        $nombreImagen = time().'_'.$imagen->getClientOriginalName();
        $imagen->move(storage_path('app/public/img'), $nombreImagen);

        $bocadillo = new Bocadillo();
        $bocadillo->nombre = $request->nombre;
        $bocadillo->precio = $request->precio;
        if(isset($request->desmontable)){
            $bocadillo->desmontable = 1;
        } else {
            $bocadillo->desmontable = 0;
        }
        $bocadillo->categoria_id = $request->tipo_id;
        $bocadillo->disponible = false;//verificar cuando estableces o metes ingredientes y, al meter al carrito y pagar
        $bocadillo->save();
        //de momento manda al index para que no se rompa
        return redirect()->route('bocadillos.listado');//formulario de ingredientes para que despues de crearlo introduzca lo que se necesita
    }

    //Mostrar un bocadillo en detalle
    public function show(Bocadillo $bocadillo){
        $extras = Ingredientes_extra::all();
        return view("bocadillos.show", compact('bocadillo', 'extras'));
    }

    //Ir al formulario para editar un bocadillo
    public function edit(Bocadillo $bocadillo){
        $tipos = Tipo::all();
        return view("bocadillos.edit", compact('bocadillo', 'tipos'));
    }

    //Cambiar datos de un bocadillo
    public function update(Request $request, Bocadillo $bocadillo){
        $bocadillo->nombre = $request->nombre;
        $bocadillo->precio = $request->precio;



        if(isset($request->desmontable)){
            $bocadillo->desmontable = 1;
        } else {
            $bocadillo->desmontable = 0;
        }
        $bocadillo->disponible = false;//verificar cuando estableces o metes ingredientes y, al meter al carrito y pagar
        if(isset($request->imagen)){
            //borra la imagen
            unlink(storage_path('app/public/img/'.$bocadillo->imagen));
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(storage_path('app/public/img'), $nombreImagen);
            $bocadillo->imagen = $nombreImagen;
        }

        $bocadillo->save();

        return redirect()->route('bocadillos.listado');//formulario de ingredientes para que despues de crearlo introduzca lo que se necesita
    }

    //Borrar un bocadillo
    public function destroy(Bocadillo $bocadillo){
        //Guardar el nombre para mostrarlo luego en el mensaje
        $n = $bocadillo->nombre;
        $imagePath = storage_path('app/public/img/bocadillos/'.$bocadillo->imagen);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $bocadillo->delete();
        return redirect()->route("bocadillos.listado")->with('status', 'Bocadillo '.$n.' eliminado con éxito');
    }

    // Listar todos los bocadillos
    public function listado()
    {
        $bocadillos = Bocadillo::all();
        return view("bocadillos.listado", compact('bocadillos'));
    }
}
