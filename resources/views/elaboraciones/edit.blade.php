@extends('layouts.plantilla')

@section('title', 'Edición de elaboración')

@section('content')
    @component('elaboraciones._components.formulario')
        @slot('productos', $productos)
        @slot('ingredientes', $ingredientes)
        @slot('elaboracion', $elaboracion)
    @endcomponent
@endsection
