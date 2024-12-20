<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Carrito;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
  
    private $cookieName = 'carrito_temporal';

    public function agregarCarrito(Request $request, $id)
    {
        $cantidad = $request->input('cantidad', 1);
        $producto = Producto::find($id);

        if (!$producto) {
            return redirect()->back()->withErrors(['Producto no encontrado.']);
        }

        if (Auth::check()) {
            $this->agregarProductoCarritoAutenticado($producto, $cantidad);
        } else {
            $carritoTemporal = $this->getCarritoTemporal();
            $carritoTemporal = $this->agregarProductoAlCarritoTemporal($producto, $cantidad, $carritoTemporal);
            return redirect()->back()->withCookie(cookie($this->cookieName, json_encode($carritoTemporal), 60 * 24 * 7))
                                 ->with('mensaje', 'Producto agregado al carrito correctamente.');
        }

        return redirect()->back()->with('mensaje', 'Producto agregado al carrito correctamente.');
    }

    public function verCarrito()
    {
        if (Auth::check()) {
            $productos = $this->obtenerCarritoAutenticado();
        } else {
            $productos = $this->getCarritoTemporal();
            if (empty($productos)) {
                return view('cliente.carrito', compact('productos'))
                       ->withCookie(cookie($this->cookieName, json_encode($productos), 60 * 24 * 7));
            }
        }

        return view('cliente.carrito', compact('productos'));
    }

    public function eliminarProductoCarrito($id)
    {
        if (Auth::check()) {
            $this->eliminarProductoCarritoAutenticado($id);
        } else {
            $carritoTemporal = $this->getCarritoTemporal();
            if (isset($carritoTemporal[$id])) {
                unset($carritoTemporal[$id]);
                return redirect()->back()->withCookie(cookie($this->cookieName, json_encode($carritoTemporal), 60 * 24 * 7))
                                     ->with('mensaje', 'Producto eliminado del carrito correctamente.');
            }
        }

        return redirect()->route('carrito')->with('mensaje', 'Producto eliminado del carrito correctamente.');
    }

    // FUNCIONES UTILES

    private function agregarProductoCarritoAutenticado($producto, $cantidad)
    {
        $carrito = Carrito::firstOrCreate(['user_id' => Auth::id()]);

        if ($carrito->productos->contains($producto->id)) {
            $carrito->productos()->updateExistingPivot($producto->id, [
                'amount' => $carrito->productos()->find($producto->id)->pivot->amount + $cantidad
            ]);
        } else {
            $carrito->productos()->attach($producto->id, ['amount' => $cantidad]);
        }
    }

    private function eliminarProductoCarritoAutenticado($id)
    {
        $carrito = Carrito::where('user_id', Auth::id())->first();
        if ($carrito) {
            $carrito->productos()->detach($id);
        }
    }

    private function agregarProductoAlCarritoTemporal($producto, $cantidad, $carritoTemporal)
    {
        if (isset($carritoTemporal[$producto->id])) {
            $carritoTemporal[$producto->id]['amount'] += $cantidad;
        } else {
            $carritoTemporal[$producto->id] = $this->iniciarProducto($producto, $cantidad);
        }
        return $carritoTemporal;
    }

    private function getCarritoTemporal()
    {
        return json_decode(request()->cookie($this->cookieName), true) ?? [];
    }

    private function iniciarProducto($producto, $cantidad)
    {
        return [
            'id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'imagen' => $producto->imagen,
            'amount' => $cantidad
        ];
    }

    private function obtenerCarritoAutenticado()
    {
        $carrito = Carrito::where('user_id', Auth::id())->with('productos:id,nombre,precio,imagen,articulos_carrito.amount')->first();
        return $carrito ? $carrito->productos : [];
    }

    public function obtenerCantidadCarrito()
{
    if (Auth::check()) {
        $productos = $this->obtenerCarritoAutenticado();
        $cantidad = $productos->sum('pivot.amount');
    } else {
        $productos = $this->getCarritoTemporal();
        $cantidad = array_sum(array_column($productos, 'amount')); 
    }

    return response()->json(['cantidad' => $cantidad]);
}
}
