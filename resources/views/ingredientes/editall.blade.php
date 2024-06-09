@extends('layouts.plantilla')

@section('title', 'Ingredientes')

@section('content')

<a href="{{ route('ingredientes.create') }}" style="text-decoration: none; color: white;"><button type="button" class="btn btn-primary">Añadir ingrediente</button></a>
<form action="{{ route('ingredientes.updateAll') }}" method="post">
    @csrf

    @method('put')
<button type="submit" class="btn btn-primary">Actualizar cantidades</button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Ingrediente</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($ingredientes as $ingrediente)
                    <tr>
                        <td>{{ $ingrediente->id }}</td>
                        <td>{{ $ingrediente->nombre }}</td>

                        <td><input type="number" step=".01" id="ingrediente-{{ $ingrediente->id }}" name="{{ $ingrediente->id }}"
                                value="{{ $ingrediente->cantidad }}">
                        </td>
                        <td>
                            <div class="row">
                                <form action={{route('ingredientes.edit', $ingrediente->id)}} method="get">
                                    @csrf
                                    <input type="submit" class="btn btn-primary btn-sm" value="Editar">
                                </form>
                                <form action={{route('ingredientes.destroy', $ingrediente->id)}} method="post">
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
            </form>
        @endsection
