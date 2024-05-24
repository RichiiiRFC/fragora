<html>
    <head>
        <title>
            @yield('titulo')
            
        </title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="content-admin">
        @include('partials.nav')
        @yield('contenido')
        </div>
    </body>
</html>