@php
    use App\Models\Categoria;

    $modoCreacion = true;
    if (isset($categoria->nombre)) {
        $modoCreacion = false;
    }

    $rutaAction = route('categorias.store');
    if(!$modoCreacion){
        $rutaAction = route('categorias.update', $categoria);

    }
@endphp

<article>
    <div class="container">
    <form action="{{$rutaAction}}" method="post">
        @csrf
        @if(!$modoCreacion)
            @method('put')
        @endif

        <label>Nombre</label><br>
        <input type="text" name="nombre" value="{{old('nombre', $categoria->nombre ?? '')}}" required><br>
        <input type="submit" class="btn btn-primary" value="Guardar cambios">
    </form>
    </div>
</article>
