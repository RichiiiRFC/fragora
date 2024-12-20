<header class="py-3 fixed-top">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-2 d-md-none text-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="col-5 col-md-3 col-xl-4">
                <a class="navbar-brand titulo-cliente" href="{{ route('inicio') }}">FRAGORA</a>
            </div>


            <div class="col-md-3 col-xl-3 d-none d-md-flex">
                <a href="{{ route('perfumes-hombre') }}">Perfumes Hombre</a>
            </div>
            <div class="col-md-3 col-xl-3 d-none d-md-flex">
                <a href="{{ route('perfumes-mujer') }}">Perfumes Mujer</a>
            </div>

            @auth
                <div class="col-3 col-md-2 col-xl-1 d-md-flex">
                    <div class="dropdown">
                        <button class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Str::limit(explode(' ', Auth::user()->name)[0], 10) }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('miperfil') }}">Mi perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            @else
                <div class=" col-3 col-md-2 col-xl-1 d-md-flex text-center">
                    <a href="{{ route('login') }}"><i class="fas fa-user fa-lg icono"></i></a>
                </div>
            @endauth


            <div class="col-2 col-md-1 col-xl-1 d-md-flex text-center position-relative">
                <a href="{{ route('carrito') }}" class="position-relative">
                    <i class="fas fa-shopping-cart fa-lg icono"></i>
                    <span class="numero-productos"></span>
                </a>
                <div id="carrito-url" data-url="{{ route('carrito.cantidad') }}"></div>
            </div>


            <div class="collapse navbar-collapse d-md-none" id="navbarNav">
                <div class="d-flex flex-column align-items-left w-100 pt-2">
                    <a href="{{ route('perfumes-hombre') }}" class="my-2">Perfumes Hombre</a>
                    <a href="{{ route('perfumes-mujer') }}" class="my-2">Perfumes Mujer</a>
                </div>
            </div>
        </div>
    </div>
</header>
