<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;
use App\Models\DetallePedido;


class PedidoController extends Controller
{

    public function index()
    {
        $pedidos = Pedido::with('usuario')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }


    public function create() {}


    public function store(Request $request) {}


    public function show(string $id) {}


    public function edit(string $id)
    {

        $pedido = Pedido::with('usuario')->findOrFail($id);

        $subtotal = $pedido->detalles->sum('subtotal');
        $subtotal = number_format($subtotal, 2, '.');


        return view('admin.pedidos.edit', compact('pedido', 'subtotal'));
    }





    public function update(Request $request, string $id)
    {

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();
        return redirect()->route('admin.pedidos.index', $pedido->id);
    }


    public function destroy(string $id) {}
}
