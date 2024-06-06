@php
    use App\Models\Ingrediente;

    $modoCreacion = true;
    if (isset($ingrediente->nombre)) {
        $modoCreacion = false;
    }

    $rutaAction = route('ingredientes.store');
    if (!$modoCreacion) {
        $rutaAction = route('ingredientes.update', $ingrediente);
    }
@endphp

<article>

    <div class="container">
        <h2 class="mt-4">{{ $modoCreacion ? 'Crear' : 'Editar' }} Ingrediente</h2>
        <form action="{{ $rutaAction }}" method="post" enctype="multipart/form-data" id="formulario">
            @csrf
            @if (!$modoCreacion)
                @method('put')
            @endif

            <div class="form-group">
                <label for="nombre">Nombre del Ingrediente:</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ old('nombre', $ingrediente->nombre ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad"
                    value="{{ old('cantidad', $ingrediente->cantidad ?? '') }}" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Guardar cambios">
        </form>
    </div>
</article>
