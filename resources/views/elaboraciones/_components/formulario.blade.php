@php
    use App\Models\Elaboracion;

    $modoCreacion = true;
    if (isset($elaboracion)) {
        $modoCreacion = false;
    }

    $rutaAction = route('elaboracion.store');
    if(!$modoCreacion){
        $rutaAction = route('elaboracion.update', $elaboracion);

    }
@endphp

<article>
    <div class="container">
    <form action="{{$rutaAction}}" method="post">
        @csrf
        @if(!$modoCreacion)
            @method('put')
        @endif

        <label>Producto</label><br>
        <select class="form-control" name="bocadillo_id" required>
            @foreach($productos as $b)
                <option value={{$b->id}} {{ (old('bocadillo_id', $elaboracion->bocadillo_id ?? '') == $b->id) ? 'selected' : '' }}>{{$b->nombre}}</option>
            @endforeach
        </select>
        <label>Ingrediente</label><br>
        <select class="form-control" name="ingrediente_id" required>
            @foreach($ingredientes as $i)
                <option value={{$i->id}} {{ (old('ingrediente_id', $elaboracion->ingrediente_id ?? '') == $i->id) ? 'selected' : '' }}>{{$i->nombre}}</option>
            @endforeach
        </select>
        <label>Cantidad</label><br>
        <input type="number" step=".01" name="cantidad" value="{{old('cantidad', $elaboracion->cantidad ?? '')}}" required><br>
        <input type="submit" class="btn btn-primary" value="Guardar cambios">
    </form>
    </div>
</article>
