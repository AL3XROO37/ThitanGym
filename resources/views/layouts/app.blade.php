<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/CRUD/clientes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardadmin.css')}}">
    <link rel="stylesheet" href="{{ asset('css/CRUD/edit.css')}}">
    <script src="{{ asset('js/header.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="body1">
    <div id="app">
        <header class="header1">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('media/logo.webp') }}" alt="Logo" class="logo-img">
            </a>


            @auth
                <ul class="navbar">
                    <li><a href="{{ route('admin.index') }}"
                            class="{{ Request::is('admin/index') ? 'active' : '' }}">Inicio</a></li>
                    <li><a href="{{ route('clientes.index') }}"
                            class="{{ Request::is('clientes') ? 'active' : '' }}">Clientes</a></li>
                    <li><a href="{{ route('paquetes.index') }}"
                            class="{{ Request::is('paquetes') ? 'active' : '' }}">Paquetes</a></li>
                    <li><a href="{{ route('agregar_paquete_cliente.index') }}"
                            class="{{ Request::is('agregar_paquete_cliente') ? 'active' : '' }}">Asignar Paquete</a></li>
                    <li><a href="{{ route('accesos.index') }}"
                            class="{{ Request::is('accesos') ? 'active' : '' }}">Accesos</a></li>
                    <li><a href="{{ route('visitas.index') }}"
                            class="{{ Request::is('visitas') ? 'active' : '' }}">Visitas</a></li>
                </ul>
            @endauth

            <div class="main">
                @guest
                    <a href="{{ route('login') }}" class="user"><i class="ri-user-fill"></i>Iniciar sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="user">Registrar</a>
                    @endif
                @else
                    <a href="#" class="user"><i class="ri-user-fill"></i>{{ Auth::user()->name }}</a>
                    <a href="{{ route('logout') }}" class="user"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bx bx-log-out"></i>Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <!-- Botón de menú para pantallas pequeñas -->
                    <div class="bx bx-menu" id="menu-icon"></div>
                @endguest

            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let menu = document.querySelector('#menu-icon');
            let navbar = document.querySelector('.navbar');

            menu.addEventListener('click', function() {
                menu.classList.toggle('bx-x');
                navbar.classList.toggle('open');
            });
        });
    </script>


</body>

</html>
