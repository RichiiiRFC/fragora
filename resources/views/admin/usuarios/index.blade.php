@extends('plantilla')
@section('titulo', 'Usuarios')
@section('contenido')
    <h1>Usuarios</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre y Apellidos</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }} {{ $usuario->apellidos }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->direccion->telefono}} </td>
                    <td>{{ $usuario->rol }}</td>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('admin.usuarios.edit', $usuario->id) }}">
                                    <i class="fas fa-edit me-1"></i> Modificar
                                </a>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST">
                                     @csrf
                                     @method('DELETE')
                                     <button class="btn btn-danger" type="submit">
                                         <i class="fas fa-trash-alt me-1"></i> Borrar
                                     </button>
                                </form>
                            </div>
                        </div>
                     </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
