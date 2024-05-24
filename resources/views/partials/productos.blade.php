<div class="content-cliente">
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ asset('images/' . $producto->imagen) }}" class="card-img-top square-img">
                    <div class="card-body">
                        <h2>{{ $producto->marca }} </h2>
                        <h5>{{ $producto->nombre }} </h5>
                        <p>{{ $producto->concentracion }} para {{ $producto->categoria }} {{ $producto->ml }}ml</p>
                        <h4>{{ $producto->precio }}€</h4>
                        <a href="{{ route('ficha.producto', $producto->id) }}" class="btn btn-success">COMPRAR</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>