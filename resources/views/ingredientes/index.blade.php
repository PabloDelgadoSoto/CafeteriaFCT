@extends('layouts.plantilla')

@section('title', 'Ingredientes')

@section('content')
<div class="cabecera">
    <h1>Listado de ingredientes</h1>
</div>
<a href="{{route('ingredientes.create')}}">Crear ingrediente</a><br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($ingredientes as $i)
    <tr>
        <th>{{$i->id}}</th>
        <th>{{$i->nombre}}</th>
        <th>{{$i->cantidad}}</th>
        <th>
            <form action="{{route('ingredientes.show', $i->id)}}" method="get" class="mt-auto">
                <button type="submit" class="btn btn-primary">Ver detalles</button>
            </form>
        </th>
    </tr>
    @endforeach
    </tbody>
</table>



@endsection
