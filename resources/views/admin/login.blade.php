@extends('plantillaBasica')

@section('titulo', 'Login')

@section('contenido')
    <div class="login-admin">

        <div class="col-md-4 login">

            <h2 class="text-center">Zona de Administración</h2>
            <form method="POST" action="{{ route('inicia-sesion-admin') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control mb-1 password-input" name="password"
                            required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary password-toggle"
                                data-target="#password">
                                Mostrar
                            </button>
                        </div>
                    </div>
                    @if (session('error'))
                        <small class="text-danger">{{ session('error') }}</small>
                    @endif
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                </div>
            </form>


        </div>
    </div>
@endsection
