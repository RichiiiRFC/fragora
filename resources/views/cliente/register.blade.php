@extends('plantillaContent')

@section('titulo', 'Registro')

@section('contenido')
    <div class="content-cliente">
       
        <h1 class="font-grande">Crear cuenta de usuario</h1>
         
        <div class="register-cliente">
            <div class="col-md-6 login">
                        <form method="POST" action="{{ route('validar-registro')}}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="form-group mt-2">
                                <label for="apellidos">Apellidos</label>
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" required autofocus>
                            </div>

                            <div class="form-group mt-2">
                                <label for="email">Correo Electrónico</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                            
                            <div class="form-group mt-2">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                            
                            <div class="form-group mt-2">
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-3">Crear Cuenta</button>
                            </div>
                        </form>
</div>
            
        </div>
    </div>

    @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


@endsection
