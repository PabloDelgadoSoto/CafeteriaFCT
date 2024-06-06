@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')
@if(Auth::check())
    @if(Auth::user()->hasRole('administrador'))
        <a href="{{route('bocadillos.create')}}">Crear bocadillo</a>
    @endif
@endif
    @foreach ($bocadillos as $b)
        @component('bocadillos._components.ficha')
            @slot('bocadillo', $b)
        @endcomponent
    @endforeach
@endsection
