<html>
    <head>
        <title>
            @yield('titulo')
            
        </title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        @include('partials.header')
        <div class="content-cliente">
        @include('partials.navperfil')
        <div class="col-md-9">
            @yield('contenido')
        </div>
    </div>
</div>
        </div>
        @include('partials.footer')
    </body>
</html>