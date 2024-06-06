<?php

namespace App\Http\Controllers;

use App\Models\Bocadillo;
use App\Models\Ingrediente;
use App\Models\Elaboracion;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __invoke(Request $request){
        $b = Bocadillo::find($request->bocata);
        $ingredientes = Elaboracion::all()->where('bocadillo_id', $b->id);
        $igs = [];
        foreach($ingredientes as $ingrediente){
            $i = Ingrediente::find($ingrediente->ingrediente_id);
            array_push($igs, $i);
        }
        $datos = [$b, $igs];
        return json_encode($datos);
    }
}
