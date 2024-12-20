@extends('plantillaAdmin')
@section('titulo', 'Crear método de pago')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-body-secondary text-center">
                        <h1>Nuevo método de pago</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.metodos_pago.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                            </div>

                            <div class="form-group my-2">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
                            </div>

                        
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark btn-lg"><i class="fas fa-plus-circle me-2"></i> Añadir Método de pago</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
