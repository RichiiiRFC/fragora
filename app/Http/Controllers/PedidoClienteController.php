<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\User;
use App\Models\Direccion;
use App\Models\Pedido;
use App\Models\DetallesPedido;
use App\Models\MetodoPago;
use App\Models\MetodoEnvio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PedidoClienteController extends Controller
{
    /********* CHECKOUT *********/
    public function mostrarCheckout(Request $request)
    {
        $cookieName = 'carrito_temporal';


        $carrito = Carrito::where('user_id', Auth::id())->with('productos')->first();

        if (Auth::check()) {

            if ($request->hasCookie($cookieName)) {
                $carritoTemporal = json_decode($request->cookie($cookieName), true);

                foreach ($carritoTemporal as $productId => $details) {

                    $productoAbuscar = $carrito->productos()->find($productId);
                    if ($productoAbuscar) {

                        $carrito->productos()->updateExistingPivot($productId, [
                            'amount' => $productoAbuscar->pivot->amount + $details['amount']
                        ]);
                    } else {

                        $carrito->productos()->attach($productId, ['amount' => $details['amount']]);
                    }
                }

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

            $subtotal = number_format($subtotal, 2, '.', '');

            $metodosPago = MetodoPago::where('activo', true)->get();
            $metodosEnvio = MetodoEnvio::where('activo', true)->get();

            return view('cliente.proceso-compra', compact('carrito', 'subtotal', 'metodosPago', 'metodosEnvio'));
        } else {

            return redirect()->guest('login')->with('status', 'Por favor, inicia sesión para poder realizar un pedido.');
        }
    }

    /********* CREACIÓN DE PEDIDOS *********/

    public function crearPedido(Request $request)
    {

        $request->validate([
            'direccion' => 'nullable|string|max:255', 
            'telefono' => 'nullable|string|max:15',  
            'ciudad' => 'nullable|string|max:50',  
            'provincia' => 'nullable|string|max:50', 
            'cod_postal' => 'nullable|string|max:5', 
            'pais' => 'nullable|string|max:50', 
        ], [
            'direccion.string' => 'La dirección debe ser una cadena de texto.',
            'direccion.max' => 'La dirección no debe exceder los 255 caracteres.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no debe exceder los 15 caracteres.',
            'ciudad.string' => 'La ciudad debe ser una cadena de texto.',
            'ciudad.max' => 'La ciudad no debe exceder los 50 caracteres.',
            'provincia.string' => 'La provincia debe ser una cadena de texto.',
            'provincia.max' => 'La provincia no debe exceder los 50 caracteres.',
            'cod_postal.string' => 'El código postal debe ser una cadena de texto.',
            'cod_postal.max' => 'El código postal no debe exceder los 5 caracteres.',
            'pais.string' => 'El país debe ser una cadena de texto.',
            'pais.max' => 'El país no debe exceder los 50 caracteres.',
        ]);
        
        $usuario = Auth::user();

        $pedido = $this->buscarOCrearPedido($usuario, $request);

        $carrito = Carrito::where('user_id', $usuario->id)->with('productos')->first();
        $totalPrecio = $this->calcularTotalCarrito($carrito);

        $metodoEnvio = MetodoEnvio::find($request->input('metodo_envio_id'));
        $totalPrecio += $metodoEnvio->costo;

        $this->actualizarPedido($pedido, $request, $totalPrecio);

        $this->guardarDetallesPedido($pedido, $carrito, false);

        $tipoPago = $this->determinarMetodoPago($request);
        if ($tipoPago === 'PayPal') {
            return $this->procesarPagoPaypal($pedido->id, $pedido->total_precio);
        }

        $this->guardarDetallesPedido($pedido, $carrito, true);

        return redirect()->route('inicio')->with('success', 'Pedido creado con éxito');
    }

    private function buscarOCrearPedido($usuario, $request)
    {
        $pedido = Pedido::where('user_id', $usuario->id)
            ->where('estado', 'Pendiente')
            ->first();

        if (!$pedido) {
            $pedido = new Pedido();
            $pedido->user_id = $usuario->id;
            $pedido->usuario_telefono = $request->input('telefono');
            $pedido->usuario_direccion = $request->input('direccion');
            $pedido->usuario_ciudad = $request->input('ciudad');
            $pedido->usuario_provincia = $request->input('provincia');
            $pedido->usuario_cod_postal = $request->input('cod_postal');
            $pedido->usuario_pais = $request->input('pais');
        }

        return $pedido;
    }

    private function calcularTotalCarrito($carrito)
    {
        $totalPrecio = 0;

        foreach ($carrito->productos as $producto) {
            $totalPrecio += $producto->precio * $producto->pivot->amount;
        }

        return $totalPrecio;
    }

    private function actualizarPedido($pedido, $request, $totalPrecio)
    {
        $pedido->total_precio = $totalPrecio;
        $pedido->metodo_pago_id = $request->input('metodo_pago_id');
        $pedido->metodo_envio_id = $request->input('metodo_envio_id');

        $pedido->estado = $this->determinarEstadoPedido($request);

        $pedido->save();
    }

    private function determinarEstadoPedido($request)
    {

        $tipoPago = $this->determinarMetodoPago($request);
        if ($tipoPago === 'Contrareembolso') {
            return 'Pago Pendiente';
        }

        return 'Pendiente';
    }


    private function determinarMetodoPago($request)
    {

        $metodoPaypalId = MetodoPago::where('nombre', 'PayPal')->first()->id;
        $metodoContrareembolsoId = MetodoPago::where('nombre', 'Contrareembolso')->first()->id;


        if ($request->input('metodo_pago_id') == $metodoPaypalId) {
            return 'PayPal';
        } elseif ($request->input('metodo_pago_id') == $metodoContrareembolsoId) {
            return 'Contrareembolso';
        }
    }

    private function guardarDetallesPedido($pedido, $carrito, $actualizarStock = false)
    {
        $pedido->detalles()->delete();
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

            if ($actualizarStock) {
                $productoDB = Producto::findOrFail($producto->id);
                $productoDB->stock -= $producto->pivot->amount;
                $productoDB->save();
            }
        }

        if ($pedido->estado !== 'Pendiente') {
            $carrito->productos()->detach();
        }
    }



    /********* PAGO CON PAYPAL *********/

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $pedido = Pedido::find($request->input('pedido_id'));
            if ($pedido) {
                $pedido->estado = 'Pagado';
                $pedido->save();
                $carrito = Carrito::where('user_id', Auth::id())->with('productos')->first();
                $this->guardarDetallesPedido($pedido, $carrito, true);

                return redirect()->route('inicio')->with('success', '¡Pago completado con éxito! Tu pedido está en proceso.');
            }
        }

        return redirect()->route('checkout');
    }


    public function paymentCancel(Request $request)
    {
        return redirect()->route('checkout');
    }

    private function procesarPagoPaypal($pedidoId, $totalPrecio)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success', ['pedido_id' => $pedidoId]),
                "cancel_url" => route('paypal.payment.cancel', ['pedido_id' => $pedidoId]),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $totalPrecio,
                    ]
                ]
            ]
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('checkout');
    }



    /********* DETALLES PEDIDO PERFIL *********/

    public function verDetallesPedido($id)
    {
        $pedido = Pedido::findOrFail($id);
        $subtotal = $pedido->detalles->sum('subtotal');
        $subtotal = number_format($subtotal, 2, '.');

        return view('cliente.detalles_pedido', compact('pedido', 'subtotal'));
    }

  

    /*private function cancelarPedido($pedidoId, $mensaje)
    {
        $pedido = Pedido::find($pedidoId);
        if ($pedido) {

            $pedido->detalles()->delete();
            $pedido->delete();
        }
            
        return redirect()->route('checkout');
    }
        */

}
