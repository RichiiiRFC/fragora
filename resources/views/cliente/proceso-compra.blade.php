@extends('plantillaContent')
@section('titulo', 'Proceso de compra')
@section('contenido')

    <div class="row proceso-compra">
        <div class="col-md-6">
            <h1>Mis Datos</h1>
            <hr>

            <form method="POST" action="{{ route('crear_pedido') }}">
                @csrf

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control mb-1" name="direccion" id="direccion"
                                value="{{ old('direccion', auth()->user()->direccion->direccion) }}" required>
                            @error('direccion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control mb-1" name="telefono" id="telefono"
                                value="{{ old('telefono', auth()->user()->direccion->telefono) }}" required>
                            @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" class="form-control mb-1" name="ciudad" id="ciudad"
                                value="{{ old('ciudad', auth()->user()->direccion->ciudad) }}" required>
                            @error('ciudad')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provincia">Provincia:</label>
                            <input type="text" class="form-control mb-1" name="provincia" id="provincia"
                                value="{{ old('provincia', auth()->user()->direccion->provincia) }}" required>
                            @error('provincia')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cod_postal">Código Postal:</label>
                            <input type="text" class="form-control mb-1" name="cod_postal" id="cod_postal"
                                value="{{ old('cod_postal', auth()->user()->direccion->cod_postal) }}" required>
                            @error('cod_postal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pais">País:</label>
                            <input type="text" class="form-control mb-1" name="pais" id="pais"
                                value="{{ old('pais', auth()->user()->direccion->pais) }}" required>
                            @error('pais')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row mt-4">

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Método de Envío</h3>
                                <hr>
                                <div class="form-group">
                                    @foreach ($metodosEnvio as $metodoEnvio)
                                        <div class="form-check mb-3">
                                            <input type="radio" class="form-check-input" name="metodo_envio_id"
                                                id="envio_{{ $metodoEnvio->id }}" value="{{ $metodoEnvio->id }}"
                                                data-costo="{{ $metodoEnvio->costo }}"
                                                @if (old('metodo_envio_id', $loop->first ? $metodoEnvio->id : '') == $metodoEnvio->id) checked @endif>
                                            <label class="form-check-label" for="envio_{{ $metodoEnvio->id }}">
                                                <strong>{{ $metodoEnvio->nombre }}
                                                    ({{ $metodoEnvio->costo }}€)</strong><br>
                                                <small class="text-muted">{{ $metodoEnvio->descripcion }}</small>
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('metodo_envio_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Método de Pago</h3>
                                <hr>
                                <div class="form-group">
                                    @foreach ($metodosPago as $metodoPago)
                                        <div class="form-check mb-3">
                                            <input type="radio" class="form-check-input" name="metodo_pago_id"
                                                id="pago_{{ $metodoPago->id }}" value="{{ $metodoPago->id }}"
                                                @if (old('metodo_pago_id', $loop->first ? $metodoPago->id : '') == $metodoPago->id) checked @endif>
                                            <label class="form-check-label" for="pago_{{ $metodoPago->id }}">
                                                <strong>{{ $metodoPago->nombre }}</strong><br>
                                                <small class="descripcion">{{ $metodoPago->descripcion }}</small>
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('metodo_pago_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
                                <td><img src="{{ asset('images/' . $producto->imagen) }}"
                                        style="width: 50px; height: auto;"></td>
                                <td>{{ $producto->marca }} {{ $producto->nombre }} {{ $producto->ml }}ml</td>
                                <td>{{ $producto->precio }}€</td>
                                <td>{{ $producto->pivot->amount }} Unidades</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p id="subtotal" data-subtotal="{{ $subtotal }}">Subtotal: {{ $subtotal }}€</p>
                <p id="envio"></p>
                <h3 id="total"></h3>
                <button type="submit" class="btn btn-success mb-3">Realizar Pedido</button>
                </form>
            @else
                <p>No hay productos en tu carrito.</p>
            @endif
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alerta-superpuesta">
            {{ session('error') }}
        </div>
    @endif

@endsection
