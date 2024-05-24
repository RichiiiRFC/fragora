@extends('plantillaMe')
@section('titulo', 'Mi Perfil')
@section('contenido')

<h1>MIS DATOS</h1>
<hr>
<div class="row cliente-perfil">
    <div class="col-md-6">
        <form action="{{ route('perfil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{ auth()->user()->apellidos }}" required>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

@endsection
