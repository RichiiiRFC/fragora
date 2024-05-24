<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand titulo-admin" href="{{ route('admin.inicio') }}">Fragora</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @auth
              {{ Auth::user()->name }}
            @endauth
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('logout-admin') }}">Cerrar Sesión</a></li>
          </ul>
        </li>
        <a class="nav-link" href="{{ route('inicio') }}"><i class="fa-solid fa-eye"></i> Ver Tienda</a>
      </ul>
    </div>

  </div>
</nav>


<div class="sidebar-admin">
  <ul class="navbar-nav">
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.productos.index') }}">
        <i class="fas fa-box"></i> Productos
      </a>
      <!--<ul class="submenu">
        <li><a href="{{ route('admin.productos.index') }}"><i class="fas fa-list"></i> Lista de Productos</a></li>
        <li><a href="{{ route('admin.productos.create') }}"><i class="fas fa-plus"></i> Añadir Producto</a></li>
        
      </ul>-->
    </li>
   
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.usuarios.index') }}">
        <i class="fas fa-users"></i> Usuarios
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.pedidos.index') }}">
        <i class="fas fa-shopping-cart"></i> Pedidos
      </a>
     
    </li>


  </ul>
</div>



