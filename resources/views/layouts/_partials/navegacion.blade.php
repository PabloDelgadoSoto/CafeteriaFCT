<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="z-index: 1000;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href={{ route('home') }}>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href={{ route('categorias.index') }}>Categorías</a>
                </li>
                @if (!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('login') }}>Login</a>
                    </li>
                @elseif(Auth::user()->hasRole('cliente'))
                    <li class="nav-item">
                        <div class="d-flex align-items-center">
                            <a class="nav-link" href={{ route('carrito.checkout') }}>Carrito</a>
                            <span class="badge bg-danger">{{ \Cart::count() }}</span>
                        </div>
                    </li>
                @elseif(Auth::user()->hasRole('administrador'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bocadillos.listado') }}">Listado de bocadillos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Ver pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ingredientes.editall') }}">Ingredientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('extras.index') }}">Ingredientes extra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('elaboracion.index') }}">Elaboraciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('tipos.index') }}>Tipos</a>
                    </li>
                @endif
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('profile.logout') }}>Logout</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">{{ Auth::user()->email }}</span>
                    </li>
                @endauth
            </ul>

        </div>

    </nav>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</header>
