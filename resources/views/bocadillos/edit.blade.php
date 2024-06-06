@extends('layouts.plantilla')

@section('title', 'Edición de producto')

@section('content')
    @component('bocadillos._components.formulario')
        @slot('tipos', $tipos)
        @slot('bocadillo', $bocadillo)
        @slot('desmontable', $bocadillo->desmontable)
    @endcomponent
@endsection
