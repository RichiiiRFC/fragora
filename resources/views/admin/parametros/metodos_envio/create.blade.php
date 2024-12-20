@extends('plantillaAdmin')
@section('titulo', 'Crear método de envio')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-body-secondary text-center">
                        <h1>Nuevo método de envio</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.metodos_envio.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                            </div>

                            <div class="form-group my-2">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
                            </div>

                            <div class="form-group my-2">
                                <label for="costo">Costo:</label>
                                <input type="number" step="0.01" class="form-control" name="costo" id="costo"
                                    required>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-dark btn-lg"><i class="fas fa-plus-circle me-2"></i>
                                    Añadir Método de Envio</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
