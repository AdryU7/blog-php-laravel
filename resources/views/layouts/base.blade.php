<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('img/icono.ico') }}">

    <!-- Todos los estilos y scripts con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js',])

    <!-- Estilos cambiantes -->
    @yield('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Titulos cambiantes -->
    <title>@yield('title')</title>
</head>

<body>

    <div class="content">
        <!-- Incluir menú -->
        @include('layouts.menu')

        <section class="section">
           @yield('content')
        </section>

        <!-- Incluir footer -->
        @include('layouts.footer')
    </div>
    <!-- Scripts cambiantes -->
    @yield('scripts')
</body>

</html>