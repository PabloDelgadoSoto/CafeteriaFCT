@extends('layouts.plantilla')

@section('title', 'Creación de tipo')

@section('content')
    @component('tipos._components.formulario')
        @slot('categorias', $categorias)
        @slot('extras', '')
    @endcomponent
@endsection
