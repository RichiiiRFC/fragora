@extends('plantillaAdmin')
@section('titulo', 'Modificar producto')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-body-secondary text-center">
                        <h1>Modificar producto</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                    value="{{ $producto->nombre }}" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="marca">Marca:</label>
                                <input type="text" class="form-control" name="marca" id="marca"
                                    value="{{ $producto->marca }}" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="ml">ML:</label>
                                <input type="text" class="form-control" name="ml" id="ml"
                                    value="{{ $producto->ml }}" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="concentracion">Concentración:</label>
                                <select class="form-control" name="concentracion" id="concentracion">
                                    <option value="Eau de Toilette"
                                        {{ $producto->concentracion == 'Eau de Toilette' ? 'selected' : '' }}>Eau de
                                        Toilette</option>
                                    <option value="Eau de Parfum"
                                        {{ $producto->concentracion == 'Eau de Parfum' ? 'selected' : '' }}>Eau de Parfum
                                    </option>
                                    <option value="Parfum" {{ $producto->concentracion == 'Parfum' ? 'selected' : '' }}>
                                        Parfum</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="stock">Stock:</label>
                                <input type="number" class="form-control" name="stock" id="stock"
                                    value="{{ $producto->stock }}" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="categoria">Categoría:</label><br>
                                <input type="radio" id="hombre" name="categoria" value="Hombre"
                                    {{ $producto->categoria == 'Hombre' ? 'checked' : '' }}>
                                <label for="hombre">Hombre</label><br>
                                <input type="radio" id="mujer" name="categoria" value="Mujer"
                                    {{ $producto->categoria == 'Mujer' ? 'checked' : '' }}>
                                <label for="mujer">Mujer</label><br>
                            </div>

                            <div class="form-group mt-2">
                                <label for="precio_base">Precio Base:</label>
                                <input type="number" step="0.01" class="form-control" name="precio_base" id="precio_base"
                                    value="{{ $producto->precio_base }}" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="descuento">Descuento:</label>
                                <select class="form-control" name="descuento" id="descuento">
                                    <option value="0" {{ $producto->descuento == 0 ? 'selected' : '' }}>Sin descuento</option>
                                    <option value="5" {{ $producto->descuento == 5 ? 'selected' : '' }}>5%</option>
                                    <option value="10" {{ $producto->descuento == 10 ? 'selected' : '' }}>10%</option>
                                    <option value="20" {{ $producto->descuento == 20 ? 'selected' : '' }}>20%</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required>{{ $producto->descripcion }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="imagen">Imagen:</label>
                                <input type="file" class="form-control-file" name="imagen" id="imagen">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark btn-lg"><i class="fas fa-edit me-1"></i>
                                    Modificar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
