@extends('layouts.plantilla')

@section('title', 'Edición de tipos')

@section('content')
    @component('tipos._components.formulario')
        @slot('categorias', $categorias)
        @slot('tipo', $tipo)
        @slot('extras', $tipo->extras)
    @endcomponent
@endsection
