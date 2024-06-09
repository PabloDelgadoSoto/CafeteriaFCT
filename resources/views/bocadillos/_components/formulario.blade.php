@php
    use App\Models\Bocadillo;

    $modoCreacion = true;
    if (isset($bocadillo->nombre)) {
        $modoCreacion = false;
    }

    $rutaAction = route('bocadillos.store');
    if(!$modoCreacion){
        $rutaAction = route('bocadillos.update', $bocadillo);
    }
@endphp

<article>
    <div class="container">
    <h2 class="mt-4">{{$modoCreacion ? 'Crear' : 'Editar'}} bocadillo</h2>
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
        <label>Precio</label><br>
        <input type="number" name="precio" step=".01" class="form-control" value="{{old('precio', $bocadillo->precio ?? '')}}" required ><br>
        </div>
        <div class="form-group">
            <label for="desmontable">Desmontable</label><br>
            <input type="checkbox" name="desmontable" value="{{old('desmontable', $desmontable ?? '')}}" @if ($desmontable==1) checked @endif>
        </div>
        <div class="form-group">
        <label for="tipo">Tipo</label>
        <select class="form-control" name="tipo_id" required>
            @foreach($tipos as $t)
                <option value={{$t->id}} {{ (old('tipo_id', $bocadillo->tipo_id ?? '') == $t->id) ? 'selected' : '' }}>{{$t->nombre}}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label>Precio de descuento</label><br>
            <p>Dejar vacío en caso de no tener descuento</p>
            <input type="number" step=".01" name="descuento" class="form-control" value="{{old('descuento', $bocadillo->descuento ?? '')}}" required ><br>
            </div>
        <input type="submit" class="btn btn-primary" value="Guardar cambios">
    </form>
    </div>
</article>
