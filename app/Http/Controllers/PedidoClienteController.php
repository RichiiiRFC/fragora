<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\User;
use App\Models\Direccion;
use App\Models\Pedido;
use App\Models\DetallesPedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class PedidoClienteController extends Controller


{

     public function mostrarCheckout(Request $request)
{
    $cookieName = 'carrito_temporal';
    $carrito = Carrito::where('user_id', Auth::id())->with('productos')->first();


    if (Auth::check()) {
        if($request->hasCookie($cookieName)){
            $carritoTemporal = json_decode($request->cookie($cookieName), true);

            foreach ($carritoTemporal as $productId => $details) {
                $productoAbuscar = $carrito->productos()->find($productId);
                if($productoAbuscar){
                    $carrito->productos()->updateExistingPivot($productId, ['amount' => $carrito->productos()->find($productId)->pivot->amount + $details['amount']]);
                }else{
                    $carrito->productos()->attach($productId, ['amount' => $details['amount']]);  
                }
                
            }
            $subtotal = 0;
            foreach ($carrito->productos as $producto) {
                $subtotal += $producto->precio * $producto->pivot->amount;
            }

            
            
            $carrito = Carrito::where('user_id', auth()->id())->with('productos')->first();
            Cookie::queue(Cookie::forget($cookieName));

        }

    foreach ($carrito->productos as $producto) {
        if ($producto->pivot->amount > $producto->stock) {
            return redirect()->route('carrito')->with('error', 'Uno o más productos en su carrito exceden el stock disponible.');
        }
    }

    $subtotal = 0;
    foreach ($carrito->productos as $producto) {
        $subtotal += $producto->precio * $producto->pivot->amount;
    }

    $subtotal = number_format($subtotal, 2, '.');
    return view('cliente.proceso-compra', compact('carrito', 'subtotal'));
}else{
     return redirect()->guest('login')->with('status', 'Por favor, inicia sesión para poder realizar un pedido.');
}
}



  public function crearPedido(Request $request)
{
        $usuario = Auth::user();
      
        $carrito = Carrito::where('user_id', Auth::id())->with('productos')->first();

        $pedido = new Pedido();
        $pedido->user_id = $usuario->id;
        $pedido->usuario_telefono = $request->input('telefono');
        $pedido->usuario_direccion = $request->input('direccion');
        $pedido->usuario_ciudad = $request->input('ciudad');
        $pedido->usuario_provincia = $request->input('provincia');
        $pedido->usuario_cod_postal = $request->input('cod_postal');
        $pedido->usuario_pais = $request->input('pais');
  

        $totalPrecio = 0;
        foreach ($carrito->productos as $producto) {
            $totalPrecio += $producto->precio * $producto->pivot->amount;
        }
        
        if ($request->input('metodo_envio') === 'envio_a_domicilio') {
            $totalPrecio += 5;
        }

        $pedido->total_precio = $totalPrecio;

        $pedido->metodo_pago = $request->input('metodo_pago');
        $pedido->metodo_envio = $request->input('metodo_envio');
        $pedido->estado = 'Pendiente';

        $pedido->save();

          foreach ($carrito->productos as $producto) {
            $detallePedido = new DetallesPedido();
            $detallePedido->pedido_id = $pedido->id;
            $detallePedido->producto_ref = $producto->ref; 
            $detallePedido->producto_nombre = $producto->nombre; 
            $detallePedido->producto_marca = $producto->marca; 
            $detallePedido->producto_ml = $producto->ml; 
            $detallePedido->producto_concentracion = $producto->concentracion; 
            $detallePedido->producto_categoria = $producto->categoria; 
            $detallePedido->producto_imagen = $producto->imagen;
            $detallePedido->producto_precio = $producto->precio; 
            $detallePedido->cantidad = $producto->pivot->amount;
            $detallePedido->subtotal = $producto->precio * $producto->pivot->amount;
            $detallePedido->save();
        }
        foreach ($carrito->productos as $producto) {
                $productoDB = Producto::findOrFail($producto->id);
                $nuevoStock = $productoDB->stock-$producto->pivot->amount;
                $productoDB->stock = $nuevoStock;
                $productoDB->save();
        }
        $carrito->productos()->detach();


        return redirect()->route('inicio');
}


public function verDetallesPedido($id)
{
    
    $pedido = Pedido::findOrFail($id);
    $subtotal = $pedido->detalles->sum('subtotal');
    $subtotal = number_format($subtotal, 2, '.');
    $precioEnvio = 5;

    return view('cliente.detalles_pedido', compact('pedido', 'subtotal', 'precioEnvio'));
}

}