@extends('plantillaContent')
@section('titulo', $producto->nombre)
@section('contenido')


    <div class="ficha-producto">
        <div class="row">
            <div class="col-md-5 mb-3">
                <img src="{{ asset('images/' . $producto->imagen) }}" class="card-img-top square-img">
            </div>
            <div class="col-md-7">
                <div class="content-ficha">
                    <h1><b>{{ $producto->marca }}</b> {{ $producto->nombre }} {{ $producto->ml }}ml</h1>
                    <p>{{ $producto->concentracion }} para {{ $producto->categoria }}</p>

                    <div class="row">
                        <div class="col-md-7">
                            <h2>
                                @if ($producto->descuento > 0)
                                    <span class="precio-descontado-ficha"><del>{{ $producto->precio_base }}€</del></span>
                                    <span>{{ $producto->precio }}€</span>
                                @else
                                    <span>{{ $producto->precio }}€</span>
                                @endif
                            </h2>
                            <h3 id="estado-stock">{{ $estado_stock }}</h3>
                        </div>
                        @if ($hay_stock)
                            <div class="col-md-5">
                                <form action="{{ route('agregarCarrito', $producto->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="number" name="cantidad" class="form-control mb-0" value="1"
                                            min="1" step="1">
                                        <button type="submit" class="btn btn-success btn-lg">Añadir al carrito</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="descripcion">
                        <h2>Descripción</h2>
                        <p>{{ $producto->descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if (session('mensaje'))
        <div class="alert alert-success alerta-superpuesta">
            {{ session('mensaje') }}
        </div>
    @endif

@endsection
