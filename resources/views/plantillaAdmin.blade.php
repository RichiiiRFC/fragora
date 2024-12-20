<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('titulo')
    </title>
    <link rel="icon" type="image/png" href="{{ asset('fragora_logo.png') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="content-admin">
        @include('partials.nav')
        @yield('contenido')
    </div>
</body>

</html>
