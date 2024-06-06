<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\Detalles_ticket;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Ingredientes_extra;
use App\Models\Elaboracion;
use App\Models\Ingrediente;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->fecha = date("Y-m-d");
        $ticket->total = $request->total;
        $ticket->hora = $request->hora;
        $ticket->user_id = Auth::user()->id;
        $ticket->save();

        foreach (Cart::content() as $producto){
            $extras = count($producto->options->extra);
            $ingredientes = count($producto->options->ings);
            $nExtras = "";
            $nIng = "";
            //que no se pueda comprar si hay menos de 0
            $t = new Detalles_ticket();
            $t->cantidad = $producto->qty;
            $t->ticket_id = $ticket->id;
            $t->bocadillo_id = $producto->name->id;

            for ($i = 0; $i < $extras; $i++){
                $extra = Ingredientes_extra::buscarId($producto->options->extra[$i]);
                $extra->cantidad -= $producto->qty;
                $nExtras = $nExtras.(string)$extra->id.'-';
                $extra->save();
            }
            $nExtras = substr($nExtras, 0, -1);
            $t->ingrediente_extra = $nExtras;
            for ($i = 0; $i < $ingredientes; $i++){
                $ing = Ingrediente::buscarId($producto->options->ings[$i]);
                $tmp = Elaboracion::buscarPorIngrediente($ing->id);
                $tmp[0]->cantidad +=1;
                $tmp[0]->save();
                $nIng = $nIng.(string)$ing->id.'-';
            }
            $nIng = substr($nIng, 0, -1);
            $t->descartados = $nIng;
            $bc = Elaboracion::buscarId($producto->name->id);
            foreach ($bc as $b){
                $in = Ingrediente::find($b->ingrediente_id);
                $cantidad = $b->cantidad*$producto->qty;
                $in->cantidad -= $cantidad;
                $in->save();
            }
            $t->save();
        }
        return redirect()->route('carrito.clear');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
