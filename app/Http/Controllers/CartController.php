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
        $datos = $request->all();
        $ing = [];
        foreach ($datos as $clave => $valor) {
            if ($valor == 'on') {
                array_push($ing, $clave);
            }
        }

        $bocadillo = Bocadillo::find($request->bocata);
        //lo mismo se puede hacer con formrequest
        if (isset($request->cantidad)) {
            $qty = $request->cantidad;
        } else {
            $qty = 1;
        }

        if ($qty < 1) {
            $errors = new MessageBag(['unidades' => ['La cantidad no puede ser menor a 1.']]);
            return Redirect::back()->withErrors($errors);
        }
        /*
        // Busca el bocadillo en el carrito
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($bocadillo) {
            return $cartItem->id === $bocadillo->id;
        })->first();

        // Si el bocadillo ya está en el carrito, obtén su cantidad
        $cantidadCarrito = $cartItem ? $cartItem->qty : 0;

        $cantidadTotal = $cantidadCarrito + $qty;
*/
        /*  Deberia hacerse antes de esto
        if ($qty > $bocadillo->unidades) {
            $errors = new MessageBag(['unidades' => ['No hay existencias suficientes para el bocadillo']]);
            return Redirect::back()->withErrors($errors);
        }
*/

        $extras = [];
        $quitar = [];
        foreach ($ing as $e) {
            $tmp = mb_substr($e, 0, 1);
            if ($tmp == 'i') {
                $nuevo = substr($e, 1);
                array_push($quitar, (int) $nuevo);
            } else {
                array_push($extras, $e);
            }
        }

        $precioInicial = 0;
        $hoy = date("Y-m-d");
        $diaSemana = date('w', strtotime($hoy));
        if ((int) $diaSemana == MIERCOLES) {
            $precioInicial = $bocadillo->descuento;
            if ($bocadillo->descuento == null) {
                $precioInicial = $bocadillo->precio;
            }
        } else {
            $precioInicial = $bocadillo->precio;
        }

        $precioTotal = $precioInicial;
        $ingredientes = [];
        $ela = Elaboracion::all()->where('bocadillo_id', $bocadillo->id);
        $todo = [];
        foreach ($ela as $e) {
            array_push($todo, $e->ingrediente_id);
        }

        if ($bocadillo->desmontable) {
            foreach ($todo as $t) {
                $p = Ingrediente::find($t);
                if (!in_array($t, $quitar)) {
                    array_push($ingredientes, $p->nombre);
                }
            }
        }


        $nombres = [];
        foreach ($extras as $e) {
            $p = Ingredientes_extra::find($e);
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
}
