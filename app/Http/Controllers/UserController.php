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
use App\Models\Dato;

class UserController extends Controller
{
    /**
     * Ver pedidos
     */
    public function createData()
    {
        $hoy = date('Y-m-d');
        // Obtiene el último ticket creado en la fecha actual
        $ticket = Ticket::where('fecha', $hoy)->latest()->first();

        if ($ticket) {
            $usuario = User::select('nia', 'name')->where('id', $ticket->user_id)->first();
            $detalles = Detalles_ticket::where('ticket_id', $ticket->id)->get();

            foreach ($detalles as $detalle) {
                $b = Bocadillo::find($detalle->bocadillo_id);
                $e = $detalle->ingrediente_extra;
                $ing = $detalle->descartados;

                // Guardar los datos en la tabla 'datos'
                Dato::create([
                    'nia' => $usuario->nia,
                    'name' => $usuario->name,
                    'hora' => $ticket->hora,
                    'bocadillo_id' => $b->nombre,
                    'ingrediente_extra' => $e,
                    'descartados' => $ing,
                    'cantidad' => $detalle->cantidad,
                    'completado' => false,
                ]);
            }
        }
    }

    public function index()
{
    // Recuperar todos los datos de la tabla 'datos'
    $datos = Dato::all();

    // Filtrar los datos completados y no completados
    $datosCompletados = $datos->where('completado', true);
    $datosNoCompletados = $datos->where('completado', false);

    return view('user.lista', ['datosCompletados' => $datosCompletados, 'datosNoCompletados' => $datosNoCompletados]);
}
public function completar($id)
{
    // Buscar el pedido con el ID proporcionado
    $pedido = Dato::find($id);

    // Comprobar si el pedido existe
    if ($pedido) {
        // Actualizar el estado del pedido a completado
        $pedido->completado = true;
        $pedido->save();
    }

    // Redirigir al usuario de vuelta a la lista de pedidos
    return redirect()->back();
}

public function completarTodos()
{
    // Buscar todos los pedidos no completados
    $pedidos = Dato::where('completado', false)->get();

    foreach ($pedidos as $pedido) {
        // Actualizar el estado del pedido a completado
        $pedido->completado = true;
        $pedido->save();
    }

    // Redirigir al usuario de vuelta a la lista de pedidos
    return redirect()->route('user.lista');
}
public function eliminarPedido($id)
{
    // Busca el pedido por ID
    $pedido = Dato::find($id);

    // Verifica si el pedido existe y si está completado
    if ($pedido && $pedido->completado) {
        // Elimina el pedido
        $pedido->delete();

        // Redirige al usuario a la página anterior con un mensaje de éxito
        return back()->with('success', 'Pedido eliminado con éxito.');
    }

    // Si el pedido no existe o no está completado, redirige al usuario a la página anterior con un mensaje de error
    return back()->with('error', 'No se pudo eliminar el pedido.');
}

public function eliminarTodosPedidos()
{
    // Elimina todos los pedidos que están completados
    Dato::where('completado', true)->delete();

    // Redirige al usuario a la página anterior con un mensaje de éxito
    return back()->with('success', 'Todos los pedidos completados han sido eliminados.');
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
