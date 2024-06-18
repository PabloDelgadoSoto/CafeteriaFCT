@extends('layouts.plantilla')
@section('title', 'Home')
@section('content')
@foreach ($datos as $d)
    <div class="row m-5">
            @foreach ($d as $tipo)

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
                @component('bocadillos._components.ficha', ['tipo' => $tipo])
                @endcomponent
            </div>
            @endforeach

    </div>
@endforeach

    <style>
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15)!important;
        }

    </style>


@endsection

