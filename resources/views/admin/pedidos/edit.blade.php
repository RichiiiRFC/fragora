@extends('plantilla')
@section('titulo', 'Modificar cliente')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-body-secondary text-center">
                        <h1>Pedido Nº {{ $pedido->id }} - {{$tipoEnvio}}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                            <h2>Datos del Pedido</h2>
                                <hr>

                            <div class="row">
                            <div class="col-md-6">
                                
                                <p><b>Usuario:</b> {{ $pedido->usuario->email }}</p>
                                <p><b>Teléfono:</b> {{ $pedido->usuario_telefono }}</p>
                                <p><b>Dirección:</b> {{ $pedido->usuario_direccion }}</p>
                                <p><b>Ciudad:</b> {{ $pedido->usuario_ciudad }}</p>
                                <p><b>Dirección:</b> {{ $pedido->usuario_cod_postal }}</p>
                                <p><b>Pais:</b> {{ $pedido->usuario_pais }}</p>
                                <p><b>Fecha:</b> {{ $pedido->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h2>Estado: </h2>
                             
                                <form action="{{ route('admin.pedidos.update', $pedido->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        
                                        <select name="estado" id="estado" class="form-control">
                                           <option value="Pendiente" {{ $pedido->estado === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="En proceso" {{ $pedido->estado === 'En proceso' ? 'selected' : '' }}>En proceso</option>
                                            <option value="Completado" {{ $pedido->estado === 'Completado' ? 'selected' : '' }}>Completado</option>
                                            <option value="Cancelado" {{ $pedido->estado === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                            
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                                </form>

                                
                                    </div> 
                                        </div> 
                                
                                
                            </div>
                            <div class="col-md-8">
                                <h2>Detalles del Pedido</h2>
                                <hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Ref.</th>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Importe Total</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pedido->detalles as $detalle)
                                                <tr>
                                                    <td><img src="{{ asset('images/' . $detalle->producto_imagen) }}"  style="width: 50px; height: auto;"></td>
                                                    <td>{{ $detalle->producto_ref}}</td>
                                                    <td><b>{{$detalle->producto_marca}}</b> {{$detalle->producto_nombre}} {{$detalle->producto_ml}}ml</td>
                                                    <td>{{ $detalle->producto_precio}}€</td>
                                                    <td>{{ $detalle->cantidad }} Uds</td>
                                                    <td>{{ $detalle->subtotal }}€</td>
            
                                                    <!-- Otros datos del detalle del pedido si es necesario -->
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <h4>Subtotal: {{$subtotal}}€<h4>
                                    <hr>
                                    <h4>Envio: {{$precioEnvio}}€<h4>
                                    <hr>
                                    <h2>TOTAL: {{ $pedido->total_precio }}€</h2>
                                    <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
