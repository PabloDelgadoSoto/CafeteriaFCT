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
        $hora = strtotime($request->hora);
        $guardar = [];
        $ticket = new Ticket();
        $ticket->fecha = date("Y-m-d");
        $ticket->total = $request->total;
        $ticket->hora = $hora; // cambiar
        $ticket->user_id = $request->user_id;
        $ticket->save(); // Guarda el ticket en la base de datos
        array_push($guardar, $ticket);

        foreach (Cart::content() as $producto) {
            $t = new Detalles_ticket();
            $t->cantidad = $producto->qty;
            $t->bocadillo_id = $producto->name->id;
            $t->ticket_id = $ticket->id;

            // Agrega los extras al objeto Detalles_ticket
            $t->ingrediente_extra = implode(", ", $producto->options->extra);

            // Agrega los ingredientes descartados al objeto Detalles_ticket
            $t->descartados = implode(", ", $producto->options->ings);

            // Guarda el Detalles_ticket en la base de datos
            $t->save();

            // Actualiza la cantidad de cada extra
            $extrasArray = explode(", ", $t->ingrediente_extra);
            foreach ($extrasArray as $extraName) {
                $extra = Ingredientes_extra::where('nombre', $extraName)->first();
                if ($extra) {
                    $extra->cantidad -= $producto->qty;
                    $extra->save();
                } else {
                    // Maneja el caso en que el extra no se encuentra
                }
            }

            // Obtiene los ingredientes del bocadillo a través de la tabla de elaboraciones
            $elaboraciones = Elaboracion::where('bocadillo_id', $producto->name->id)->get();
            foreach ($elaboraciones as $elaboracion) {
                $ingrediente = Ingrediente::find($elaboracion->ingrediente_id);
                if ($ingrediente) {
                    // Si el ingrediente no está en la lista de descartados, resta la cantidad
                    if (!in_array($ingrediente->nombre, $producto->options->ings)) {
                        $ingrediente->cantidad -= $producto->qty;
                        $ingrediente->save();
                    }
                } else {
                    // Maneja el caso en que el ingrediente no se encuentra
                }
            }
        }

        // Vacía el carrito
        Cart::destroy();
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
