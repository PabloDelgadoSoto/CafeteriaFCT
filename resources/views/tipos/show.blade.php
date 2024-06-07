@extends('layouts.plantilla')

@section('title', 'Detalles de producto')

@section('content')
@if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    <div class="container" style="text-align: center; display:flex; justify-content:center;">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card" style="width: 18rem;">
                    <img src="{{ url('storage/img/' . $tipo->imagen) }}" style="padding:10px">

                    <div class="card-body">
                        <div class="extras" aria-multiselectable="true">
                            <h2>{{ $tipo->nombre }}</h2>
                            <form name="form" action="{{ route('carrito.add') }}" method="post">
                                @csrf
                                <select name="bocata" onchange="precio();return false;">
                                    @foreach ($bocadillos as $b)
                                        <option value={{ $b->id }}>{{ $b->nombre }}</option>
                                    @endforeach
                                </select>
                                <p>Precio: <b id="precio"> </b>€</p>
                                <div id="prec">
                                </div>
                                {{ $tipo->descripcion }}
                                <div id="colocar">
                                </div>

                                @if ($tipo->extras == 1)
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
                                        <input type="hidden" id="bocadillo" name="tipo" value="{{ $tipo->id }}"><br>
                                        <input type="submit" class="btn btn-primary" value="Añadir producto">
                                        @if (session('status'))
                                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4"
                                                role="alert">
                                                <p style="color: red">{{ session('status') }}</p>
                                            </div>
                                        @endif
                                </form>
                            @elseif(Auth::user()->hasRole('administrador'))
                                </form>
                                <form action="{{ route('tipos.edit', $tipo->id) }}" method="get" class="mt-auto">
                                    <input type="submit" class="btn btn-primary" value="Editar">
                                </form>
                            @endauth
                        @else
                            <a href="{{ route('login') }}">Inicie sesión para hacer su pedido</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
