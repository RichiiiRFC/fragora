@extends('plantillaAdmin')
@section('titulo', 'Crear producto')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-body-secondary text-center">
                        <h1>Nuevo producto</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ref">Nº Ref:</label>
                                <input type="text" class="form-control" name="ref" id="ref" required>
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="marca">Marca:</label>
                                <input type="text" class="form-control" name="marca" id="marca" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="ml">ML:</label>
                                <input type="text" class="form-control" name="ml" id="ml" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="concentracion">Concentración:</label>
                                <select class="form-control" name="concentracion" id="concentracion">
                                    <option value="Eau de Toilette">Eau de Toilette</option>
                                    <option value="Eau de Parfum">Eau de Parfum</option>
                                    <option value="Parfum">Parfum</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="stock">Stock:</label>
                                <input type="number" class="form-control" name="stock" id="stock" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="categoria">Categoría:</label><br>
                                <input type="radio" id="hombre" name="categoria" value="Hombre">
                                <label for="hombre">Hombre</label><br>
                                <input type="radio" id="mujer" name="categoria" value="Mujer">
                                <label for="mujer">Mujer</label><br>
                            </div>

                            <div class="form-group mt-2">
                                <label for="precio_base">Precio base:</label>
                                <input type="number" step="0.01" class="form-control" name="precio_base"
                                    id="precio_base" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="descuento">Descuento (%):</label>
                                <select class="form-control" name="descuento" id="descuento" required>
                                    <option value="0">Sin descuento</option>
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="imagen">Imagen:</label>
                                <input type="file" class="form-control-file" name="imagen" id="imagen" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark btn-lg"><i class="fas fa-plus-circle me-2"></i>
                                    Añadir Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
