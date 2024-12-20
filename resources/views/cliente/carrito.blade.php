@extends('plantillaContent')
@section('titulo', 'Carrito de compras')
@section('contenido')


    <div class="carrito">
        <h1>Carrito de compras</h1>

        @if (sizeof($productos) > 0)

            <table class="table">

                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td><img src="{{ asset('images/' . $producto['imagen']) }}" style="width: 65px; height: auto;">
                            </td>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ $producto['precio'] }}€</td>
                            <td>{{ $producto['amount'] }} Uds.</td>
                            <td>
                                <form action="{{ route('eliminar.producto.carrito', $producto['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('checkout') }}" class="btn btn-success">
                Ir al proceso de compra
            </a>
        @else
            <p>No hay productos en el carrito.</p>
        @endif
    </div>


    @if (session('error'))
        <div class="alert alert-danger alerta-superpuesta">
            {{ session('error') }}
        </div>
    @endif

@endsection
