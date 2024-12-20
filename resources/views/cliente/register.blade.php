@extends('plantillaContent')

@section('titulo', 'Registro')

@section('contenido')

    <h1 class="font-grande">Crear cuenta de usuario</h1>

    <div class="register-cliente">
        <div class="col-10 col-md-6 login mb-4">
            <form method="POST" action="{{ route('validar-registro') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" type="text" class="form-control mb-1" name="name" value="{{ old('name') }}"
                        required autofocus>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="apellidos">Apellidos</label>
                    <input id="apellidos" type="text" class="form-control mb-1" name="apellidos"
                        value="{{ old('apellidos') }}" required autofocus>
                    @error('apellidos')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control mb-1" name="email"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control mb-1 password-input" name="password"
                            required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary password-toggle" data-target="#password">
                                Mostrar
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-group">
                        <input id="password_confirmation" type="password" class="form-control mb-1 password-input"
                            name="password_confirmation" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary password-toggle"
                                data-target="#password_confirmation">
                                Mostrar
                            </button>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-3">Crear Cuenta</button>
                </div>
            </form>
        </div>
    </div>


    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
