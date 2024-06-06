@extends('layouts.plantilla')

@section('title', 'Categoria')

@section('content')
    @foreach ($bocadillos as $b)
        {{$b->nombre}}
    @endforeach
@endsection
