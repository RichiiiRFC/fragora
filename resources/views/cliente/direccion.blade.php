@extends('plantillaMe')
@section('titulo', 'Mi Dirección')
@section('contenido')

<h1>DIRECCIÓN</h1>
<hr>
<div class="row cliente-perfil">
    <div class="col-md-6">
        
        <form action="{{ route('direccion.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" name="direccion" id="direccion" value="{{ auth()->user()->direccion->direccion }}" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="{{ auth()->user()->direccion->telefono }}" required>
            </div>

            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" class="form-control" name="ciudad" id="ciudad" value="{{ auth()->user()->direccion->ciudad }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
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
</form>
    </div>
</div>

@endsection
