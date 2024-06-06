@extends('layouts.plantilla')

@section('title', 'Categorias')

@section('content')
@auth
    @if(Auth::user()->hasRole('administrador'))
        <a href="{{route('categorias.create')}}"><button type="button" class="btn btn-primary">Crear categoría</button></a>
    @endif
@endauth
<div class="row m-5">

    @foreach ($categorias as $c)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
    <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
            <h1 class="card-title">{{$c->nombre}}</h1>
            <form action="{{route('categorias.show', $c->id)}}" method="get" class="mt-auto">
                <button type="submit" class="btn btn-primary">Ver productos</button>
            </form>
        @auth
            @if(Auth::user()->hasRole('administrador'))

                <form action="{{route('categorias.edit', $c->id)}}" method="get" class="mt-auto">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </form>
                <form action="{{route('categorias.destroy', $c->id)}}" method="get" class="mt-auto">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>

            @endif
        @endauth
    </div>
</div>
    </div>
    @endforeach
</div>
@endsection
