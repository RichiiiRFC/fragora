@extends('plantillaContent')
@section('titulo', 'Login')
@section('contenido')


    <div class="content-cliente">
        <h1 class="font-grande">Iniciar Sesión</h1>

        
        <div class="register-cliente">
            <div class="col-md-6 login">
                
                       
                        <form method="POST" action="{{ route('inicia-sesion') }}">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="email">Correo Electrónico</label>
                                <input id="email" type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group mt-2">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>

                            <div class="form-group">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>
                            </div>

                            <div>
                                <p class="mt-2">¿No tienes cuenta? <a href="{{route('registro')}}">Registrate</a></p>

                            </div>
                        
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </form>
        </div>
    </div>
</div>
@if (session('status'))
            <div class="alert alert-warning">
                {{ session('status') }}
            </div>
        @endif

@if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

@endsection
