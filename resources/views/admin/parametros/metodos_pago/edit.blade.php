@extends('plantillaAdmin')
@section('titulo', 'Modificar método de pago')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-body-secondary text-center">
                        <h1>Modificar método de pago</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.metodos_pago.update', $metodoPago->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') 

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $metodoPago->nombre }}" required>
                            </div>

                            <div class="form-group my-2">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required>{{ $metodoPago->descripcion }}</textarea>
                            </div>

                            <div class="form-group form-check my-3">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    name="activo" 
                                    id="activo" 
                                    value="1" 
                                    {{ $metodoPago->activo ? 'checked' : '' }}>
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>


                            <div class="text-end">
                                <button type="submit" class="btn btn-dark btn-lg"><i class="fas fa-edit me-1"></i> Modificar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
