@extends('layouts.plantilla')

@section('title', 'Creación de elaboración')

@section('content')
    @component('elaboraciones._components.formulario')
        @slot('productos', $productos)
        @slot('ingredientes', $ingredientes)
    @endcomponent
@endsection
