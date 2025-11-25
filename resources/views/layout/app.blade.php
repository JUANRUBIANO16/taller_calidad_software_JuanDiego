<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="main-layout">
    {{-- Sidebar --}}
    @include('component.sidebar')

    {{-- Contenido principal --}}
    <div class="main-wrapper">
        {{-- Header --}}
        @include('component.header')

        {{-- Contenido dinámico --}}
        <div class="main-content">
            @yield('contenido')
        </div>
    </div>
</body>
</html>


