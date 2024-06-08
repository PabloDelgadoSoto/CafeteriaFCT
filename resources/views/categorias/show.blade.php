@extends('layouts.plantilla')

@section('title', 'Categoria')

@section('content')
<h1>{{$categoria->nombre}}</h1>
<div class="row m-5">

    @foreach ($tipos as $tipo)

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
        @component('bocadillos._components.ficha', ['tipo' => $tipo])
        @endcomponent
    </div>
    @endforeach

</div>
@endsection
