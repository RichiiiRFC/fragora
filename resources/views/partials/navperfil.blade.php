<div class="list-group ">
    <a class="d-md-none mb-2 nav-link dropdown-toggle menu-perfil" href="#" data-bs-toggle="collapse" data-bs-target="#menuPerfil" aria-expanded="false" aria-controls="menuPerfil">
        @switch(Route::currentRouteName())
            @case('miperfil')
                Mis Datos
                @break
            @case('midireccion')
                Mi Dirección
                @break
            @case('mispedidos')
                Pedidos
                @break
            @default
                Mis datos
        @endswitch
    </a>

    <div class="collapse d-md-block mb-2" id="menuPerfil">
        <a href="{{ route('miperfil') }}" class="list-group-item list-group-item-action">Mis datos</a>
        <a href="{{ route('midireccion') }}" class="list-group-item list-group-item-action">Mi dirección</a>
        <a href="{{ route('mispedidos') }}" class="list-group-item list-group-item-action">Pedidos</a>
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action cerrar-sesion">Cerrar Sesión</a>
    </div>
</div>




     
        