@extends('plantillaMe')
@section('titulo', 'Mis Pedidos')
@section('contenido')

    <h1>MIS PEDIDOS</h1>
    <hr>
    <div class="row cliente-perfil">
        <div class="col">
            @if (Auth::user()->pedidos->where('estado', '!=', 'Pendiente')->isEmpty())
                <h3 class="text-center">No tienes pedidos realizados todavía.</h3>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Fecha</th>
                            <th class="d-none d-md-table-cell">Total</th>
                            <th class="d-none d-lg-table-cell">Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->pedidos->where('estado', '!=', 'Pendiente') as $pedido)
                            <tr>
                                <td>{{ $pedido->id }}</td>
                                <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                                <td class="d-none d-md-table-cell">{{ $pedido->total_precio }}€</td>
                                <td class="d-none d-lg-table-cell">{{ $pedido->estado }}</td>
                                <td>
                                    <a href="{{ route('detalles-pedido', $pedido->id) }}" class="btn btn-outline-dark">Ver
                                        Detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection


