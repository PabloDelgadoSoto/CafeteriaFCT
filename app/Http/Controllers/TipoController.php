<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Ingredientes_extra;
use App\Models\Bocadillo;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //Devolver todos los bocadilloss, revisar para meter paginacion
    public function index(){
        $tipos = Tipo::all();
        return view("tipos.index", compact('tipos'));
    }

    //Ir al formulario de crear
    public function create(){
        $categorias = Categoria::all();
        return view("tipos.create", compact('categorias'));
    }

    //Crear bocadillo nuevo
    public function store(Request $request){


        $tipo = new Tipo();
        $tipo->nombre = $request->nombre;
        $tipo->descripcion = $request->descripcion;
        $tipo->categoria_id = $request->categoria_id;
        if(isset($request->extra)){
            $tipo->extras = 1;
        } else {
            $tipo->extras = 0;
        }
        if(isset($request->imagen)){
            //borra la imagen
            unlink(storage_path('app/public/img/'.$tipo->imagen));
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('assets'), $nombreImagen);
            $tipo->imagen = $nombreImagen;
        }
        else{
            $tipo->imagen = $tipo->nombre . '.png';
        }

        $tipo->save();
        return redirect()->route('tipos.index');//formulario de ingredientes para que despues de crearlo introduzca lo que se necesita
    }

    //Mostrar un bocadillo en detalle
    public function show(Tipo $tipo){
        $extras = Ingredientes_extra::all();
        $bocadillos = Bocadillo::all()->where('tipo_id', $tipo->id);
        return view("tipos.show", compact('tipo', 'extras', 'bocadillos'));
    }

    //Ir al formulario para editar un bocadillo
    public function edit(Tipo $tipo){
        $categorias = Categoria::all();
        return view("tipos.edit", compact('tipo', 'categorias'));
    }

    //Cambiar datos de un bocadillo
    public function update(Request $request, Tipo $tipo){
        $tipo->nombre = $request->nombre;
        $tipo->descripcion = $request->descripcion;
        $tipo->categoria_id = $request->categoria_id;
        if(isset($request->extra)){
            $tipo->extras = 1;
        } else {
            $tipo->extras = 0;
        }
        if(isset($request->imagen)){
            //borra la imagen
            unlink(storage_path('app/public/img/'.$tipo->imagen));
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('assets'), $nombreImagen);
            $tipo->imagen = $nombreImagen;
        }
        else{
            $tipo->imagen = $tipo->nombre . '.png';
        }
        $tipo->save();

        return redirect()->route('tipos.index');//formulario de ingredientes para que despues de crearlo introduzca lo que se necesita
    }

    //Borrar un bocadillo
    public function destroy(Tipo $tipo){
        //Guardar el nombre para mostrarlo luego en el mensaje
        $n = $tipo->nombre;
        unlink(storage_path('app/public/img/bocadillos/'.$tipo->imagen));
        $tipo->delete();
        return redirect()->route("tipos.index")->with('status', 'Tipo '.$n.' eliminado con éxito');
    }

    // Listar todos los bocadillos
    public function listado()
    {
        $bocadillos = Tipo::all();
        return view("tipos.listado", compact('bocadillos'));
    }
}
