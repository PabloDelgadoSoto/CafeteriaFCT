@extends('layouts.plantilla')

@section('title', 'Detalles de ingrediente')

@section('content')
    {{$ingrediente->nombre}}
    {{$ingrediente->cantidad}}
    <form action="{{route('ingredientes.edit', $ingrediente->id)}}" method="get" class="mt-auto">
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
    <form action="{{route('ingredientes.destroy', $ingrediente->id)}}" method="get" class="mt-auto">
        <button type="submit" class="btn btn-primary">Eliminar</button>
    </form>
@endsection
