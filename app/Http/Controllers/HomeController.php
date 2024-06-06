<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Categoria;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function __invoke()
    {
        $categoria = Categoria::all();
        $datos = [];
        foreach ($categoria as $c){
            $tipos = Tipo::all()->where('categoria_id', $c->id);
            array_push($datos, $tipos);
        }

        return view('home', compact('datos'));
    }
}
