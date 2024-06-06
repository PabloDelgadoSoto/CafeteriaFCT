<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Tipo;

class CategoriaController extends Controller
{
    //Mostrar todas las categorías
    public function index(){
        $categorias = Categoria::all();
        return view("categorias.index", compact('categorias'));
    }

    //Ir al formulario de crear categorías
    public function create(){
        return view("categorias.create");
    }

    //Crear una nueva categoria
    public function store(Request $request){
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return redirect()->route('categorias.index');
    }

    //Ver los productos de una categoria
    public function show(Categoria $categoria){
        $tipos = Tipo::all()->where('categoria_id', $categoria->id);
        return view("home", compact('tipos'));
    }

    //Ir al formulario de editar una categoria
    public function edit(Categoria $categoria){
        return view("categorias.edit", compact('categoria'));
    }

    //Cambiar datos de una categoria
    public function update(Request $request, Categoria $categoria){
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return redirect()->route('categorias.index');
    }

    //Eliminar categoria
    public function destroy(Categoria $categoria){
        //Nombre de la categoria para el mensaje de borrado
        $n = $categoria->nombre;
        $categoria->delete();
        //Si no se hace index de categorias hay que cambiar esta ruta
        return redirect()->route("categorias.index")->with('status', 'Categoría '.$n.'eliminada con éxito');

    }
}
