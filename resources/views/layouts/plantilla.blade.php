<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>

<header>
    <h1>Entradas</h1>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="cerrar-sesion">Cerrar Sesión</button>
    </form>
</header>

<main>
    @yield('contenido')
</main>

<footer>
    <p>Desarrollo de Aplicaciones Web - Desarrollo Web en Entorno Servidor</p>
</footer>

</body>
</html>
