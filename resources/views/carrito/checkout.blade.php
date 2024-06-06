@extends('layouts.plantilla')

@section('title', 'Carrito')

@section('content')
<div class="container">
    <h2 class="mt-4">Carrito de la compra</h2>
    <h2>Total: {{Cart::subtotal()}} €</h2>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('carrito.clear') }}"><button type="button" class="btn btn-danger btn-sm">Vaciar carrito</button></a>
        </div>
        <form action="{{ route('tickets.store') }}" method="post">
            @csrf
            <div class="col-md-6">
               <input type="submit" value="Pagar" class="btn btn-primary btn-sm">
            </div>
            <input type="hidden" name="total" value="{{Cart::subtotal()}}">
            <label>Hora de recogida</label>
            <select name="hora">
                <option value="8">8:30</option>
                <option value="9">9:25</option>
                <option value="10">10:20</option>
                <option value="11">11:10</option>
                <option value="11.5">11:40</option>
                <option value="12">12:35</option>
                <option value="13">13:30</option>
                <option value="14">14:20</option>

                <option value="4">16:00</option>
                <option value="5">16:55</option>
                <option value="6">17:50</option>
                <option value="6.5">18:40</option>
                <option value="7">19:05</option>
                <option value="8">20:00</option>
                <option value="9">20:55</option>
                <option value="10">21:45</option>
            </select>
        </form>
    </div>
<table class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Extras</th>
            <th>Ingredientes eliminados</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
    @foreach (Cart::content() as $producto)
    <tr>
        <th>{{$producto->name->nombre}}</th>
        <th>{{$producto->id}} €</th>
        <th>{{$producto->qty}}</th>
        <th>
        @for ($i = 0; $i < count($producto->options->extra); $i++)
            {{$producto->options->extra[$i]}}
        @endfor
        </th>
        <th>
            @for ($i = 0; $i < count($producto->options->ings); $i++)
                {{$producto->options->ings[$i]}}
            @endfor
            </th>
        <th>{{ number_format($producto->qty * $producto->price, 2) }} €</th>
        <th>
            <form method="post" action="{{ route('carrito.remove', $producto->rowId) }}">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger btn-sm" value="Eliminar del carrito">
            </form>
        </th>
    <tr>
    <br>
    @endforeach
    </tbody>
</table>

<form action="{{ route('payment.pay') }}" method="post">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}">
    <button type="submit">Pagar</button>
</form>

</div>
@endsection
