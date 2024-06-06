@extends('layouts.plantilla')

@section('title', 'Carrito')

@section('content')
<div class="container">
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <h2 class="mt-4">Carrito de la compra</h2>
    <h2>Total: {{Cart::subtotal()}} €</h2>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('carrito.clear') }}"><button type="button" class="btn btn-danger btn-sm">Vaciar carrito</button></a>
        </div>
        <form action="{{ route('tickets.store') }}" method="post">
            @csrf
            <div class="row">
            <div class="col-md-6">
               <input type="submit" value="Pagar" class="btn btn-primary btn-sm">
            </div>

            <div class="col-md-6">
            <select name="hora">
                <option value="11.10">11:10</option>
                <option value="14.20">14:20</option>

                <option value="18.40">18:40</option>
                <option value="21.45">21:45</option>
            </select>
            </div>
        </div>
        <input type="hidden" name="total" value="{{Cart::subtotal()}}">
        </form>
    </div>
    @if (session('status'))
                <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                    <p style="color: red">{{ session('status') }}</p>
                </div>
            @endif
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
