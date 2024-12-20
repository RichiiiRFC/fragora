<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Carrito;

class ProductoClienteController extends Controller
{
    public function listaProductos()
    {
        $productos = Producto::get();
        return view('cliente.inicio', compact('productos'));
    }


    public function productosHombre()
    {
        $productos = Producto::where('categoria', 'Hombre')->get();
        return view('cliente.hombre', compact('productos'));
    }


    public function productosMujer()
    {
        $productos = Producto::where('categoria', 'Mujer')->get();
        return view('cliente.mujer', compact('productos'));
    }


    public function fichaProducto($id)
    {
        $producto = Producto::find($id);

        if ($producto->stock > 0) {
            $estado_stock = 'En stock';
            $hay_stock = true;
        } else {
            $estado_stock = 'Sin stock';
            $hay_stock = false;
        }

        return view('cliente.ficha-producto', compact('producto', 'estado_stock', 'hay_stock'));
    }
}
