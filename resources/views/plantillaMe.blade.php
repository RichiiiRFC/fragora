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
    @include('partials.header')
    <div class="content-cliente container">
        <div class="row">
            <div class="col-md-3">
                @include('partials.navperfil')
            </div>
            <div class="col-md-9">
                @yield('contenido')
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>

</html>
