<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('titulo')
    </title>
    <link rel="icon" type="image/png" href="{{ asset('fragora_logo.png') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @include('partials.header')
    <div class="container content-cliente">
        @yield('contenido')
    </div>
    @include('partials.footer')
</body>

</html>
