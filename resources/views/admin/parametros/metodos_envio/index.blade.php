@extends('plantillaAdmin')
@section('titulo', 'Métodos de envío')
@section('contenido')
    <h1>Métodos de envío</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Activo</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($metodosEnvio as $metodoEnvio)
                <tr>

                    <td>{{ $metodoEnvio->nombre }}</td>
                    <td>{{ Str::limit($metodoEnvio->descripcion, 100) }}</td>
                    <td>{{ $metodoEnvio->costo }}€</td>
                    <td>{{ $metodoEnvio->activo ? 'Si' : 'No' }}
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('admin.metodos_envio.edit', $metodoEnvio->id) }}">
                                    <i class="fas fa-edit me-1"></i> Modificar
                                </a>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('admin.metodos_envio.destroy', $metodoEnvio) }}" method="POST">
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

    <div class="text-end">
        <a href="{{ route('admin.metodos_envio.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle me-2"></i> Añadir Método de Envío
        </a>
    </div>
@endsection
