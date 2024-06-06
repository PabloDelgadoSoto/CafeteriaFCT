@extends('layouts.plantilla')

@section('title', 'Edición de ingrediente extra')

@section('content')
    @component('extras._components.formulario')
        @slot('extra', $extra)
    @endcomponent
@endsection
