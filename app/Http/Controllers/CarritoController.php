<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Carrito;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    

    public function agregarCarrito(Request $request,$id)
{
    $producto = Producto::find($id);
    $cantidad = $request->input('cantidad', 1);


    if (Auth::check()) {
        $userId = Auth::id();
        $carrito = Carrito::where('user_id', $userId)->first();

        /*if (!$carrito) {
            $carrito = new Carrito();
            $carrito->user_id = $userId;
            $carrito->save();
        }*/

        if ($carrito->productos->contains($producto->id)) {
            // Si el producto ya está en el carrito, se actualiza la cantidad
            $carrito->productos()->updateExistingPivot($producto->id, ['amount' => $carrito->productos()->find($producto->id)->pivot->amount + $cantidad]);
        } else {
        // Si el producto no está en el carrito, se agrega
        $carrito->productos()->attach($producto->id, ['amount' => $cantidad]);
        }

        return redirect()->back()->with('mensaje', 'Producto agregado al carrito correctamente.');
    } else {
        // Obtenemos el carrito temporal actual
        $cookieName = 'carrito_temporal';
        $carritoTemporal = json_decode(request()->cookie($cookieName), true) ?? [];

        // Actualizamos carrito temporal
        $carritoActualizado = $this->agregarProductoAlCarritoTemporal($id, $cantidad, $carritoTemporal);

        return redirect()->back()->withCookie(cookie($cookieName, json_encode($carritoActualizado), 60*24*7))
                                         ->with('mensaje', 'Producto agregado al carrito correctamente.');
    }
}

public function verCarrito(Request $request)
{
    $cookieName = 'carrito_temporal';
    $productos = [];

    if (Auth::check()) {
        $userId = Auth::id();
    
        $carrito = Carrito::where('user_id', $userId)->with('productos:id,nombre,precio,imagen,articulos_carrito.amount')->first();

        $productos = $carrito->productos;
    } else {
        // Si el usuario no está autenticado, comprobamos si tiene uno temporal
        $productos = json_decode(request()->cookie($cookieName), true) ?? [];
        
        if (!$productos) {  
            //Establecemos la cookie del carrito temporal
            return view('cliente.carrito', compact('productos'))->withCookie(cookie($cookieName, json_encode($productos), 60*24*7));
        }     
    }

    return view('cliente.carrito', compact('productos'));
}



// FUNCIONES UTILES
public function agregarProductoAlCarritoTemporal($id, $cantidad, $carritoTemporal)
{
    if (isset($carritoTemporal[$id])) {
        $carritoTemporal[$id]['amount']+=$cantidad;
    } else {
        $nuevoProducto = $this->iniciarProducto($id, $cantidad);
        $carritoTemporal[$id] = $nuevoProducto;
    }
    return $carritoTemporal;
}

public function iniciarProducto($id, $cantidad){
    $producto = Producto::find($id);
    return [
            'id' => $producto->id,
            'nombre' =>$producto->nombre,
            'precio' => $producto->precio,
            'imagen' => $producto->imagen,
            'amount' => $cantidad
        ];
}

public function eliminarProductoCarrito($id) {
    if (Auth::check()) {
        $userId = Auth::id();
        $carrito = Carrito::where('user_id', $userId)->firstOrFail();
        $carrito->productos()->detach($id);
    } else {
        
        $cookieName = 'carrito_temporal';
        $carritoTemporal = json_decode(request()->cookie($cookieName), true) ?? [];

        
        if (isset($carritoTemporal[$id])) {
            unset($carritoTemporal[$id]); 
            return redirect()->back()->withCookie(cookie($cookieName, json_encode($carritoTemporal), 60*24*7));
        }
    }

    return redirect()->route('carrito')->with('mensaje', 'Producto eliminado del carrito exitosamente.');
}

}
