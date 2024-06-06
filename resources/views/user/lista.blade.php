@extends('layouts.plantilla')

@section('title', 'Lista de pedidos')

@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>NIA</th>
            <th>Nombre usuario</th>
            <th>Hora</th>
            <th>Nombre Bocadillo</th>
            <th>Ingredientes extra</th>
            <th>Ingredientes eliminados</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $d)

            <tr>
                <th>{{$d[0]}}</th>
                <th>{{$d[1]}}</th>
                <th>{{$d[2]}}</th>
                <th>{{$d[3]->nombre}}</th>
                <th>{{$d[4]}}</th>
                <th>{{$d[5]}}</th>
                <th>{{$d[6]}}</th>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
