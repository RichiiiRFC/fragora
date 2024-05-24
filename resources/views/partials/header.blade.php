<header class="bg-dark py-3 fixed-top">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-4">
        <a class="navbar-brand titulo-cliente" href="{{ route('inicio') }}">FRAGORA</a>
      </div>

      <div class="col-md-2">
        <a href="{{ route('perfumes-hombre') }}" class="text-white">Perfumes Hombre</a>
      </div>
      <div class="col-md-2">
        <a href="{{ route('perfumes-mujer')}}" class="text-white">Perfumes Mujer</a>
      </div>
      
      @auth
      <div class="col-md-2">
        <div class="dropdown">
          <button class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="{{ route('miperfil') }}">Mi perfil</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
      @else
      <div class="col-md-2">
        <a href="{{route('login')}}" class="text-white"><i class="fas fa-user fa-lg icono"></i></a>
      </div>
      @endauth

      <div class="col-md-2">
        <a href="{{route('carrito')}}" class="text-white"> <i class="fas fa-shopping-cart fa-lg icono"></i></a>
      </div>
      
    </div>
  </div>
</header>
