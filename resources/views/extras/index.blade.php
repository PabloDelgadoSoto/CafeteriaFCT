@extends('layouts.plantilla')

@section('title', 'Ingredientes')

@section('content')

    <a href="{{ route('extras.create') }}" style="text-decoration: none; color: white;"><button type="button"
            class="btn btn-primary">Añadir ingrediente extra</button></a>
    <form action="{{ route('extras.updateAll') }}" method="post">
        @csrf

        @method('put')
        <button type="submit" class="btn btn-primary">Actualizar cantidades</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Ingrediente</th>
                    <th>Coste extra</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($extras as $extra)
                    <tr>
                        <td>{{ $extra->id }}</td>
                        <td>{{ $extra->nombre }}</td>
                        <td><input type="number" id="coste-{{ $extra->id }}" name="coste_{{ $extra->id }}"
                                value="{{ $extra->coste_extra }}" step="0.01">
                        </td>
                        <td><input type="number" id="cantidad-{{ $extra->id }}" name="cantidad_{{ $extra->id }}"
                                value="{{ $extra->cantidad }}">
                        </td>
                        <td>
                            <div class="row">
                                <form action={{ route('extras.edit', $extra->id) }} method="get">
                                    @csrf
                                    <input type="submit" class="btn btn-primary btn-sm" value="Editar">
                                </form>
                                <form action={{ route('extras.destroy', $extra->id) }} method="post">
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
