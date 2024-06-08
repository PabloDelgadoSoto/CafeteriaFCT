@php
    use App\Models\Bocadillo;

    $modoCreacion = true;
    if (isset($bocadillo->nombre)) {
        $modoCreacion = false;
    }

    $rutaAction = route('tipos.store');
    if(!$modoCreacion){
        $rutaAction = route('tipos.update', $bocadillo);
    }
@endphp

<article>
    <div class="container">
    <h2 class="mt-4">{{$modoCreacion ? 'Crear' : 'Editar'}} tipo de bocadillo</h2>
    <form action="{{$rutaAction}}" method="post" enctype="multipart/form-data">
        @csrf
        @if(!$modoCreacion)
            @method('put')
        @endif
        <div class="form-group">
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" class="form-control" value="{{old('nombre', $bocadillo->nombre ?? '')}}" required>
        </div>
        <div class="form-group">
        <label for="descripcion">Descripción</label><br>
        <textarea name="descripcion" class="form-control" required>{{old('descripcion', $bocadillo->descripcion ?? '')}}</textarea><br>
        </div>
        <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" class="form-control-file" value="{{old('imagen', $bocadillo->imagen ?? '')}}">
        </div>
        <div class="form-group">
            <label for="extras">Tiene extras</label><br>
            <input type="checkbox" name="extras" value="{{old('extras', $extras ?? '')}}" @if ($extras==1) checked @endif>
        </div>
        <div class="form-group">
        <label for="categoria">Categoría</label>
        <select class="form-control" name="categoria_id" required>
            @foreach($categorias as $c)
                <option value={{$c->id}} {{ (old('categoria_id', $tipo->categoria_id ?? '') == $c->id) ? 'selected' : '' }}>{{$c->nombre}}</option>
            @endforeach
        </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Guardar cambios">
    </form>
    </div>
</article>
