<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use App\Models\Elaboracion;
use App\Models\Bocadillo;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;
use App\Models\Ingredientes_extra;

const MIERCOLES = 3;

class CartController extends Controller
{

    public function add(Request $request)
    {
        /*
        date_default_timezone_set('Europe/Madrid');
        $nueve = date("09:00:00");
        $tres = date("15:00:00");
        $cinco = date("17:30:00");
        $diez = date("23:59:59");
        $ahora = date("H:i:s");
        if(($ahora > $nueve && $ahora < $tres) || ($ahora > $cinco && $ahora < $diez)){
            return back()->with('status', 'En este momento no se permite comprar ningún producto, inténtalo más tarde.');
        }
            */
        $datos = $request->all();
        $ing = [];
        foreach ($datos as $clave => $valor) {
            if($valor=='on'){
                array_push($ing, $clave);
            }
        }

        $bocadillo = Bocadillo::find($request->bocata);

        if (isset($request->cantidad)) {
            $qty = $request->cantidad;
        } else {
            $qty = 1;
        }

        if ($qty < 1) {
            $errors = new MessageBag(['unidades' => ['La cantidad no puede ser menor a 1.']]);
            return Redirect::back()->withErrors($errors);
        }

        $extras = [];
        $quitar = [];
        foreach($ing as $e){
            $tmp = mb_substr($e, 0, 1);
            if($tmp == 'i'){
                $nuevo = substr($e, 1);
                array_push($quitar, (int) $nuevo);
            } else {
                array_push($extras, $e);
            }
        }

        $precioInicial = 0;
        $hoy = date("Y-m-d");
        $diaSemana = date('w', strtotime($hoy));
        if((int) $diaSemana == MIERCOLES){
            $precioInicial = $bocadillo->descuento;
            if($bocadillo->descuento == null){
                $precioInicial = $bocadillo->precio;
            }
        } else {
            $precioInicial = $bocadillo->precio;
        }

        $precioTotal = $precioInicial;
        $ingredientes = [];
        $ela = Elaboracion::all()->where('bocadillo_id', $bocadillo->id);
        $todo = [];
        $cantidades = [];
        foreach($ela as $e){
            array_push($todo, $e->ingrediente_id);
            array_push($cantidades, $e->cantidad);
        }

        if($bocadillo->desmontable){
            for($i = 0; $i < count($todo); $i++){
                $p = Ingrediente::find($todo[$i]);
                if(!in_array($todo[$i], $quitar)){
                    array_push($ingredientes, $p->nombre);
                    if($cantidades[$i] > $p->cantidad){
                        return back()->with('status', 'No hay suficiente cantidad de '.$p->nombre);
                    }
                }
            }
        }

        $nombres = [];
        foreach($extras as $e){
            $p = Ingredientes_extra::find($e);
            if($qty > $p->cantidad){
                return back()->with('status', 'No hay suficiente cantidad de '.$p->nombre);
            }
            $precioTotal += $p->coste_extra;
            array_push($nombres, $p->nombre);
        }


        Cart::add([
            //esto es terrorismo pero no hay tiempo
            'id' => $precioInicial,
            'name' => $bocadillo,
            'price' => $precioTotal,
            'qty' => $qty,
            'options' => ['extra' => $nombres, 'ings' => $ingredientes]
        ]);

        return Redirect::back()->with('success', 'Bocadillo añadido al carrito correctamente.');

    }

    public function checkout()
    {
        $total = Cart::total();

        return view('carrito.checkout', compact('total'));
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with("success", "Producto eliminado del carrito");
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->back()->with("success", "Carrito vaciado");
    }

    public function getTotal()
    {
        return Cart::subtotal();
    }
}
