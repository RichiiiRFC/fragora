@extends('plantillaAdmin')
@section('titulo', 'Modificar cliente')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-body-secondary text-center">
                        <h1>Modificar Usuario</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                            @csrf
                            @method('PUT') 

                            <div class="row">
                                <div class="col-md-6">
                                
                                    <div class="form-group">
                                        <label for="name">Nombre:</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $usuario->name }}" required>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="apellidos">Apellidos:</label>
                                        <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{ $usuario->apellidos }}" required>
                                    </div>

                                        <div class="form-group mt-2">
                                            <label for="email">Email:</label>
                                            <p class="form-control" id="email">{{ $usuario->email }}</p>
                                        </div>


                                    <div class="form-group mt-2">
                                        <label for="rol">Rol:</label>
                                        <select class="form-control" name="rol" id="rol">
                                            <option value="admin" {{ $usuario->rol === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="cliente" {{ $usuario->rol === 'cliente' ? 'selected' : '' }}>Cliente</option>
                                        </select>
                                    </div>
                                

                                </div>

                                <div class="col-md-6">
                                   
                                    <div class="form-group">
                                        <label for="direccion">Dirección:</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{$usuario->direccion->direccion}}">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" value="{{$usuario->direccion->telefono}}">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="ciudad">Ciudad:</label>
                                        <input type="text" class="form-control" name="ciudad" id="ciudad" value="{{$usuario->direccion->ciudad}}">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="provincia">Provincia:</label>
                                        <input type="text" class="form-control" name="provincia" id="provincia" value="{{$usuario->direccion->provincia}}">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="cod_postal">Código Postal:</label>
                                        <input type="text" class="form-control" name="cod_postal" id="cod_postal" value="{{$usuario->direccion->cod_postal}}">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="pais">País:</label>
                                        <input type="text" class="form-control" name="pais" id="pais" value="{{$usuario->direccion->pais}}">
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-dark btn-lg"><i class="fas fa-edit me-1"></i> Modificar Usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
