<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    @yield('styles')

    @yield('scripts')
    <style>
        .navbar {
            background-color: #333;
            /* color de fondo de la barra de navegación */
            color: white;
            /* color de texto de la barra de navegación */
        }
    </style>
    <title>@yield('title')</title>


</head>

<body>
    @include('layouts._partials.navegacion')
    <main>
        @yield('content')
    </main>
</body>

</html>
