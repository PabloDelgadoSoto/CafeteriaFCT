<header>
    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href={{route('home')}}>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href={{route('categorias.index')}}>Categorías</a>
                </li>
            @if(!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href={{route('login')}}>Login</a>
                </li>
            @elseif(Auth::user()->hasRole('cliente'))
                <li class="nav-item">
                    <a class="nav-link" href={{route('carrito.checkout')}}>Carrito</a>
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
                    <a class="nav-link" href={{route('tipos.index')}}>Tipos</a>
                </li>
            @endif
            @auth
                <li class="nav-item">
                    <a class="nav-link" href={{route('profile.logout')}}>Logout</a>
                </li>
                <li class="nav-item">
                    <span class="nav-link">{{Auth::user()->email}}</span>
                </li>
            @endauth
            </ul>
        </div>
    </nav>
</header>
