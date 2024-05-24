@extends('plantilla')
@section('titulo', 'Pedidos')
@section('contenido')
    <h1>Pedidos</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nº Pedido</th>
                <th>Usuario</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Fecha</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{$pedido->usuario->email}}</td>
                    <td>{{ $pedido->usuario_telefono }}</td>
                    <td>{{ $pedido->estado}}</td>
                    <td>{{ $pedido->total_precio}}€</td>
                    <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                     <td>
                        <a class="btn btn-primary" href="{{ route('admin.pedidos.edit', $pedido->id) }}">
                            <i class="fa-regular fa-eye"></i> 
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
