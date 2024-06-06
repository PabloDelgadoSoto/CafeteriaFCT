@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')
<a href="{{ route('tipos.create') }}" style="text-decoration: none; color: white;"><button type="button" class="btn btn-primary btn-sm">Añadir Tipo</button></a>
<div class="row m-5">
    @foreach ($tipos as $tipo)

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
        @component('bocadillos._components.ficha', ['tipo' => $tipo])
        @endcomponent
    </div>
    @endforeach

</div>
@endsection
