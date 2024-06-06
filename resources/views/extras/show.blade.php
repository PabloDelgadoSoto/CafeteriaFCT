@extends('layouts.plantilla')

@section('title', 'Detalles de ingrediente extra')

@section('content')
    {{$extra->nombre}}
    {{$extra->coste_extra}} €
    <div class="row">
        <form action={{route('extras.edit', $extra->id)}} method="delete">
            @csrf
            <input type="submit" class="btn btn-primary btn-sm" value="Editar">
        </form>
        <form action={{route('extras.destroy', $extra->id)}}>
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
        </form>
        </div>
@endsection
