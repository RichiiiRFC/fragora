@extends('plantillaContent')
@section('titulo', 'Proceso de compra')
@section('contenido')

<div class="content-cliente">
    <div class="row">
        <div class="col-md-6"> 
            <h1>Mis Datos</h1>
            <hr>

            <form method="POST" action="{{ route('crear_pedido') }}">

                @csrf

        <div class="row">

            <div class="col-md-6">
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ auth()->user()->direccion->direccion }}" required>
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" class="form-control" name="telefono" id="telefono" value="{{ auth()->user()->direccion->telefono }}" requiered>
    </div>

    <div class="form-group">
        <label for="ciudad">Ciudad:</label>
        <input type="text" class="form-control" name="ciudad" id="ciudad" value="{{ auth()->user()->direccion->ciudad }}" required>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="provincia">Provincia:</label>
        <input type="text" class="form-control" name="provincia" id="provincia" value="{{ auth()->user()->direccion->provincia }}" required>
    </div>

    <div class="form-group">
        <label for="cod_postal">Código Postal:</label>
        <input type="text" class="form-control" name="cod_postal" id="cod_postal" value="{{ auth()->user()->direccion->cod_postal }}" required>
    </div>

    <div class="form-group">
        <label for="pais">País:</label>
        <input type="text" class="form-control" name="pais" id="pais" value="{{ auth()->user()->direccion->pais }}" required>
    </div>
</div>

</div>

    <div class="row mt-5">
    <div class="col-md-6">
        <h3>Método de envio</h3>
        <hr>
        <div class="row">
        
        <label>
        <input type="radio" name="metodo_envio" id="envio_a_domicilio" value="envio_a_domicilio" checked>
            Envío a domicilio (5€)
        </label>
       
</div>
    </div>

    <div class="col-md-6">
        <h3>Método de pago</h3>
        <hr>
        <label>
            <input type="radio" name="metodo_pago" value="contrareembolso" checked>
            Contrareembolso
        </label>
        
    </div>
   

</div>



        </div>
        <div class="col-md-6"> 
            <h1>Detalles del pedido</h1>
            <hr>

            @if ($carrito)
                <table class="table">
                    <thead>
                       
                    </thead>
                    <tbody class="detalles-compra">
                        @foreach ($carrito->productos as $producto)
                            <tr>
                                 <td><img src="{{ asset('images/' . $producto->imagen) }}"  style="width: 50px; height: auto;"></td>
                                <td>{{ $producto->marca}} {{ $producto->nombre }} {{ $producto->ml }}ml</td>
                                <td>{{ $producto->precio }}€</td>
                                <td>{{ $producto->pivot->amount }} Unidades</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p id="subtotal" data-subtotal="{{ $subtotal }}">Subtotal: {{ $subtotal }}€</p>
                <p id="envio"></p>
                <h3 id="total"></h3>
                <button type="submit" class="btn btn-success">Realizar Pedido</button>
                </form>
            @else
                <p>No hay productos en tu carrito.</p>
            @endif
        </div>
    </div>
</div>




@endsection
