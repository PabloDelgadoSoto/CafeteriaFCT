@extends('layouts.plantilla')

@section('title', 'Creación de producto')

@section('content')
    @component('bocadillos._components.formulario')
        @slot('tipos', $tipos)
        @slot('desmontable', '')
    @endcomponent
@endsection
