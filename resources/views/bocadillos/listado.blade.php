@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')

    <a href="{{ route('bocadillos.create') }}" style="text-decoration: none; color: white;"><button type="button" class="btn btn-primary btn-sm">Añadir Bocadillo</button></a>
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
                    <div class="row">
                        <form action={{route('bocadillos.edit', $bocadillo->id)}} method="get">
                            <input type="submit" class="btn btn-primary btn-sm" value="Editar">
                        </form>
                        <form action={{route('bocadillos.destroy', $bocadillo->id)}} method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                        </form>
                        </div>
                </td>
            </tr>
        @endforeach
            </tbody>
    </table>
    @endsection
