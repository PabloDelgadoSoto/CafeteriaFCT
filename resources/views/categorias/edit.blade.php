@extends('layouts.plantilla')

@section('title', 'Edición de categoria')

@section('content')
    @component('categorias._components.formulario')
        @slot('categoria', $categoria)
    @endcomponent
@endsection
