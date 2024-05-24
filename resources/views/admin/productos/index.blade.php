@extends('plantilla')
@section('titulo', 'Productos')
@section('contenido')
    <h1>Productos</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nº Ref.</th>
                <th>Nombre del Producto</th>
                <th>Concentración</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->ref }}</td>
                    <td><b>{{ $producto->marca }}</b>  {{ $producto->nombre }}  {{ $producto->ml }}ml</td>
                    <td>{{ $producto->concentracion }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->categoria }}</td>
                    <td>{{ $producto->precio }}€</td>
                    <td><img src="{{ asset('images/' . $producto->imagen) }}" style="width: 50px; height: 50px;"></td>
                    
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('admin.productos.edit', $producto->id) }}">
                                    <i class="fas fa-edit me-1"></i> Modificar
                                </a>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST">
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
        <a href="{{ route('admin.productos.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle me-2"></i> Añadir Producto
        </a>
    </div>
@endsection
