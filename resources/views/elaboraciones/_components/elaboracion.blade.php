<a href="{{ route('elaboracion.create') }}" style="text-decoration: none; color: white;"><button type="button" class="btn btn-primary btn-sm">Crear nuevo conjunto</button></a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Ingrediente</th>
            <th>Cantidad utilizada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($elaboraciones as $e)
            <tr>
                <td>{{ $e->id }}</td>
                <td>{{ $productos[$e->bocadillo_id] }}</td>
                <td>{{ $ingredientes[$e->ingrediente_id] }}</td>
                <td>{{ $e->cantidad }}</td>
                <td>
                    <div class="row">
                    <form action={{route('elaboracion.edit', $e->id)}} method="get">
                        @csrf
                        <input type="submit" class="btn btn-primary btn-sm" value="Editar">
                    </form>
                    <form action={{route('elaboracion.destroy', $e->id)}} method="post">
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

