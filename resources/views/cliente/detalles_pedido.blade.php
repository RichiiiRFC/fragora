@extends('plantillaMe')
@section('titulo', 'Mis Pedidos')
@section('contenido')

<h1>Nº PEDIDO {{ $pedido->id }}</h1>
<hr>
<div class="row cliente-perfil">
    <div class="col">

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Ref.</th>
                    <th>Cantidad</th>
                    <th>Importe Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detalles as $detalle)
                <tr>
                    <td><img src="{{ asset('images/' . $detalle->producto_imagen) }}"  style="width: 50px; height: auto;"></td>
                    <td>{{ $detalle->producto_nombre }}</td>
                    <td>{{ $detalle->producto_ref }}</td>
                    <td>{{ $detalle->cantidad }} Unidades</td>
                    <td>{{ $detalle->subtotal }}€</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>


    <h5>Subtotal: {{$subtotal}}€</h5>
    <hr>
    <h5>Envio: {{$precioEnvio}}€</h5>
    <hr>
    <h2>Total: {{$pedido->total_precio}}€</h2>
    <hr>

</div>
@endsection
