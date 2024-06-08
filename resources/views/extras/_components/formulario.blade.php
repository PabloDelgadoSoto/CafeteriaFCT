@php
    use App\Models\Ingredientes_extra;

    $modoCreacion = true;
    if (isset($extra->nombre)) {
        $modoCreacion = false;
    }

    $rutaAction = route('extras.store');
    if(!$modoCreacion){
        $rutaAction = route('extras.update', $extra);
    }
@endphp

<article>
    <div class="container">
        <h2 class="mt-4">{{$modoCreacion ? 'Crear' : 'Editar'}} Ingrediente Extra</h2>
    <form action="{{$rutaAction}}" method="post" enctype="multipart/form-data">
        @csrf
        @if(!$modoCreacion)
            @method('put')
        @endif
        <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{old('nombre', $extra->nombre ?? '')}}" required>
        </div>
        <div class="form-group">
        <label for="Cantidad">Cantidad</label>
        <input type="number" name="cantidad" class="form-control" value="{{old('coste_extra', $extra->cantidad ?? '')}}" required>
        <label for="Coste_extra">Coste extra</label>
        <input type="number" step="0.01" name="coste_extra" class="form-control" value="{{old('coste_extra', $extra->coste_extra ?? '')}}" required>
        </div>
        <input type="submit" class="btn btn-primary" value="Guardar cambios">
    </form>
    </div>
</article>
