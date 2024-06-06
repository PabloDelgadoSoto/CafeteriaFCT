@extends('layouts.plantilla')

@section('title', 'Edición de producto')

@section('content')

    @component('ingredientes._components.formulario')
        @slot('ingrediente', $ingrediente)
    @endcomponent
@endsection
