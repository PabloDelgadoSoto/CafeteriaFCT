

<div class="card h-100 shadow-sm">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{$tipo->nombre}}</h5>
        <img src="{{asset('assets/'.$tipo->imagen)}}" class="card-img-top" alt="{{$tipo->nombre}}">
        <p class="card-text">{{$tipo->descripcion}}</p>
        <form action="{{route('tipos.show', $tipo->id)}}" method="get" class="mt-auto">
            <button type="submit" class="btn btn-primary">Ver detalles</button>
        </form>
    </div>
</div>


