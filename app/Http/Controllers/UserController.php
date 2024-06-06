<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Ingredientes_extra;
use App\Models\Ingrediente;
use App\Models\Bocadillo;
use App\Models\Detalles_ticket;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Ver pedidos
     */
    public function index()
    {
        $hoy = date("Y-m-d");
        $tickets = Ticket::all()->where('fecha', $hoy);
        $datos = [];
        foreach($tickets as $t){
            $usuario = User::select('nia', 'name')->where('id', $t->user_id)->get();
            $cuales = Detalles_ticket::select('bocadillo_id', 'ingrediente_extra', 'descartados', 'cantidad')->where('ticket_id', $t->id)->distinct()->get();
            $b = Bocadillo::find($cuales[0]->bocadillo_id);
            $e = $cuales[0]->ingrediente_extra;
            $ing = $cuales[0]->descartados;
            $tmp = [$usuario[0]->nia, $usuario[0]->name, $t->hora, $b, $e, $ing, $cuales[0]->cantidad];
            array_push($datos, $tmp);
        }
        return view("user.lista", compact("datos"));
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
        //
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
