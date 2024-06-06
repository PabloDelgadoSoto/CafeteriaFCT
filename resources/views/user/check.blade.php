@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')
<a href="{{ route('tipos.create') }}" style="text-decoration: none; color: white;"><button type="button" class="btn btn-primary btn-sm">Añadir Bocadillo</button></a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Bocadillo</th>
                <th>Precio</th>
                <th>Disponibilidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
            <tbody>
            @foreach ($bocadillos as $bocadillo)
            <tr>
                <td>{{ $bocadillo->id }}</td>
                <td>{{ $bocadillo->nombre }}</td>
                <td>{{ $bocadillo->precio }}</td>
                <td>
                    @if ($bocadillo->disponible == 0)
                        No disponible
                    @elseif ($bocadillo->disponible == 1)
                        Disponible
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="window.location='{{ route('bocadillos.edit', $bocadillo->id) }}'">Editar</button>
                    <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>
        @endforeach
            </tbody>
    </table>
    @endsection
