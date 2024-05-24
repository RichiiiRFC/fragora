@extends('plantillaMe')
@section('titulo', 'Mis Pedidos')
@section('contenido')

<h1>MIS PEDIDOS</h1>
<hr>
<div class="row cliente-perfil">
    <div class="col">

        <table class="table">
            <thead>
                <tr>
                    <th>Nº Pedido</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
                @foreach(Auth::user()->pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                    <td>{{ $pedido->total_precio }}€</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>

                        <a href="{{ route('detalles-pedido', $pedido->id) }}" class="btn btn-outline-dark">Ver Detalles</a>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

      
      
        
    </div>
</div>

@endsection


