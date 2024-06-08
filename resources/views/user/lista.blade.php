@extends('layouts.plantilla')

@section('title', 'Lista de pedidos')

@section('content')
<form method="POST" action="{{ route('completarTodos') }}">
    @csrf
    <button type="submit" class="btn btn-primary">Completar todos</button>
</form>
<h2>Pedidos no completados</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>NIA</th>
            <th>Nombre usuario</th>
            <th>Hora</th>
            <th>Nombre Bocadillo</th>
            <th>Ingredientes extra</th>
            <th>Ingredientes eliminados</th>
            <th>Cantidad</th>
            <th>Completar</th>
        </tr>
    </thead>
    <!-- Código para los encabezados de la tabla -->
    <tbody>
        @foreach ($datosNoCompletados as $d)
            <tr>
                <!-- Código para mostrar los datos del pedido -->
                <th>{{$d->nia}}</th>
                <th>{{$d->name}}</th>
                <th>{{$d->hora}}</th>
                <th>{{$d->bocadillo_id}}</th>
                <th>{{$d->ingrediente_extra}}</th>
                <th>{{$d->descartados}}</th>
                <th>{{$d->cantidad}}</th>
                <th><form method="POST" action="{{ route('completarPedido', $d->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Completar</button>
                </form></th>
            </tr>
        @endforeach
    </tbody>
</table>


<h2>Pedidos completados</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>NIA</th>
            <th>Nombre usuario</th>
            <th>Hora</th>
            <th>Nombre Bocadillo</th>
            <th>Ingredientes extra</th>
            <th>Ingredientes eliminados</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datosCompletados as $d)
            <tr>
                <th>{{$d->nia}}</th>
                <th>{{$d->name}}</th>
                <th>{{$d->hora}}</th>
                <th>{{$d->bocadillo_id}}</th>
                <th>{{$d->ingrediente_extra}}</th>
                <th>{{$d->descartados}}</th>
                <th>{{$d->cantidad}}</th>
                <th>
                    <form action="{{ route('pedido.eliminar', $d->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route('pedido.eliminarTodos') }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar todos los pedidos completados</button>
</form>
@endsection
