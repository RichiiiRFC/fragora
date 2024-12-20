@extends('plantillaContent')

@section('titulo', 'Login')

@section('contenido')

    <h1 class="font-grande">Iniciar Sesión</h1>

    <div class="register-cliente">
        <div class="col-10 col-md-6 login">

            <form method="POST" action="{{ route('inicia-sesion') }}">
                @csrf

                <div class="form-group mt-2">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control mb-1" name="email" value="{{ old('email') }}" required>
                </div>
                

                <div class="form-group mt-2">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control mb-1 password-input" name="password" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary password-toggle" data-target="#password">
                                Mostrar
                            </button>
                        </div>
                    </div>
                     @if (session('error'))
                        <small class="text-danger">{{ session('error') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Recordarme
                        </label>
                    </div>
                </div>

                <div>
                    <p class="mt-2">¿No tienes cuenta? <a href="{{ route('registro') }}">Regístrate</a></p>
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-warning alerta-superpuesta">
            {{ session('status') }}
        </div>
    @endif

@endsection
