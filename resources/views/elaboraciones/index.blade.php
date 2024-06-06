@extends('layouts.plantilla')

@section('title', 'Elaboraciones')

@section('content')
            @component('elaboraciones._components.elaboracion')
                @slot('elaboraciones', $elaboraciones)
                @slot('ingredientes', $ingredientes)
                @slot('productos', $productos)
            @endcomponent
@endsection

