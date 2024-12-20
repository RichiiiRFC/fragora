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
                    <input type="text" class="form-control mb-1" name="name" id="name"
                        value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control mb-1" name="apellidos" id="apellidos"
                    value="{{ old('apellidos', auth()->user()->apellidos) }}" required>
                @error('apellidos')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group mb-3">
                <input type="checkbox" id="alternar_password">
                <label for="alternar_password">Cambiar Contraseña</label>
            </div>

            <div id="password_fields" style="display: none;">
    <div class="form-group">
        <label for="password_actual">Contraseña Actual:</label>
        <div class="input-group">
            <input type="password" class="form-control mb-1 password-input" name="password_actual" id="password_actual">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary password-toggle" data-target="#password_actual">
                    Mostrar
                </button>
            </div>
        </div>
        @if ($errors->has('password_actual'))
            <small class="text-danger">{{ $errors->first('password_actual') }}</small>
        @endif
    </div>

    <div class="form-group">
        <label for="password_nueva">Nueva Contraseña:</label>
        <div class="input-group">
            <input type="password" class="form-control mb-1 password-input" name="password_nueva" id="password_nueva">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary password-toggle" data-target="#password_nueva">
                    Mostrar
                </button>
            </div>
        </div>
        @error('password_nueva')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_nueva_confirmation">Confirmar Nueva Contraseña:</label>
        <div class="input-group">
            <input type="password" class="form-control mb-1 password-input" name="password_nueva_confirmation" id="password_nueva_confirmation">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary password-toggle" data-target="#password_nueva_confirmation">
                    Mostrar
                </button>
            </div>
        </div>
    </div>
</div>

        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success alerta-superpuesta">
            {{ session('success') }}
        </div>
    @elseif(session('status'))
        <div class="alert alert-success alerta-superpuesta">
            {{ session('status') }}
        </div>
    @endif


@endsection
