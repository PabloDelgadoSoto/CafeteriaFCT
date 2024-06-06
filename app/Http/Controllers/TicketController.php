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
        $guardar = [];
        $ticket = new Ticket();
        $ticket->fecha = date("Y-m-d");
        $ticket->total = $request->total;
        $ticket->hora = $request->hora;
        $ticket->user_id = Auth::user()->id;
        array_push($guardar, $ticket);

        foreach (Cart::content() as $producto){
            $extras = count($producto->options->extra);
            $ingredientes = count($producto->options->ings);
            $nExtras = "";
            $nIng = "";

            $t = new Detalles_ticket();
            $t->cantidad = $producto->qty;

            $t->bocadillo_id = $producto->name->id;

            for ($i = 0; $i < $extras; $i++){
                $extra = Ingredientes_extra::buscarId($producto->options->extra[$i]);
                if((double) $producto->qty > $extra->cantidad*$producto->qty){
                    return back()->with('status', 'No hay suficiente cantidad de '.$extra->nombre);
                }
                $extra->cantidad -= $producto->qty;
                $nExtras = $nExtras.(string)$extra->id.'-';
                array_push($guardar, $extra);
            }
            $nExtras = substr($nExtras, 0, -1);
            $t->ingrediente_extra = $nExtras;
            $desc = [];
            for ($i = 0; $i < $ingredientes; $i++){
                $ingre = Ingrediente::buscarId($producto->options->ings[$i]);
                $ing = Ingrediente::find($ingre);
                array_push($desc, $ing[0]->id);
                $nIng = $nIng.(string)$ing[0]->id.'-';
            }
            $nIng = substr($nIng, 0, -1);
            $t->descartados = $nIng;

            $bc = Elaboracion::buscarId($producto->name->id);
            foreach ($bc as $b){
                $in = Ingrediente::find($b->ingrediente_id);
                if(in_array($in->id, $desc)){
                    continue;
                }
                $cantidad = $b->cantidad*$producto->qty;
                if($cantidad > $in->cantidad){
                    return back()->with('status', 'No hay suficiente cantidad de '.$in->nombre);
                }
                $in->cantidad -= $cantidad;
                array_push($guardar, $in);
            }
            foreach($guardar as $g){
                $g->save();
            }
            $t->ticket_id = $ticket->id;
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
