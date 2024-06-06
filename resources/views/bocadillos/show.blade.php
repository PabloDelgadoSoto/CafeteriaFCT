@extends('layouts.plantilla')

@section('title', 'Detalles de producto')

@section('content')
    <div class="container" style="text-align: center; display:flex; justify-content:center;">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card" style="width: 18rem;">
                    <img src="{{ url('storage/img/' . $bocadillo->imagen) }}" style="padding:10px">

                    <div class="card-body">
                        <div class="extras" aria-multiselectable="true">
                            <h2>{{ $bocadillo->nombre }}</h2>
                            <p>Precio: <b>{{ $bocadillo->precio }} €</b></p>

                            {{ $bocadillo->descripcion }}

                            <form action="{{ route('carrito.add') }}" method="post">
                                @csrf
                                @if($bocadillo->prod==1)
                                    <hr>
                                    <label>Selecciona un extra:</label>
                                    <br>
                                    @foreach ($extras as $e)
                                        @component('extras._components.lista')
                                            @slot('extra', $e)
                                        @endcomponent
                                    @endforeach
                                    @endif
                                    @auth
                                    @if (Auth::user()->hasRole('cliente'))
                                        <label>Cantidad</label>
                                        <input type="number" name="cantidad" min="1" step="1">
                                        <input type="hidden" id="bocadillo" name="bocadillo" value="{{ $bocadillo->id }}"><br>
                                        <input type="submit" class="btn btn-primary" value="Añadir producto">
                            </form>
                                    @elseif(Auth::user()->hasRole('administrador'))
                            </form>
                                        <form action="{{ route('tipos.edit', $tipo->id) }}" method="get"
                                            class="mt-auto">
                                            <input type="submit" class="btn btn-primary" value="Editar">
                                        </form>
                                            @endauth
                                    @else
                                    <a href="{{route('login')}}">Inicie sesión para hacer su pedido</a>

                                    @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
