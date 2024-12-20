<div class="row">
    @foreach ($productos as $producto)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
            <a href="{{ route('ficha.producto', $producto->id) }}" class="text-decoration-none h-100">
                <div class="card card-productos h-100">
                    <img src="{{ asset('images/' . $producto->imagen) }}" class="card-img-top img-fluid square-img" alt="{{ $producto->nombre }}">
                    <div class="card-body d-flex flex-column">
                        <h2>{{ $producto->marca }}</h2>
                        <h5>{{ $producto->nombre }}</h5>
                        <p>{{ $producto->concentracion }} para {{ $producto->categoria }} {{ $producto->ml }}ml</p>
                        <h4>
                            @if ($producto->descuento > 0)
                                <span class="precio-descontado"><del>{{ $producto->precio_base }}€</del></span>
                                <span>{{ $producto->precio }}€</span>
                            @else
                                <span>{{ $producto->precio }}€</span>
                            @endif
                        </h4>
                    </div>
                    <hr class="my-0">
                    <div class="verMas pt-3 pb-2">
                        <h5 class="text-center"><strong>Ver Más</strong></h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>




