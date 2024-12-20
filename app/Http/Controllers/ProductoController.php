<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller

{

    public function index()
    {
        $productos = Producto::get();
        return view('admin.productos.index', compact('productos'));
    }


    public function create()
    {
        return view('admin.productos.create');
    }


    public function store(Request $request)
    {

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $precioFinal = $request->precio_base * (1 - $request->descuento / 100);

        $producto = new Producto();
        $producto->ref = $request->ref;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio_base = $request->precio_base;
        $producto->precio = $precioFinal;
        $producto->descuento = $request->descuento;
        $producto->stock = $request->stock;
        $producto->categoria = $request->categoria;
        $producto->marca = $request->marca;
        $producto->ml = $request->ml;
        $producto->concentracion = $request->concentracion;
        $producto->imagen = $imageName;
        $producto->save();

        return redirect()->route('admin.productos.index');
    }


    public function show(string $id) {}


    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.edit', compact('producto'));
    }


    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $rutaImagenAnterior = $producto->imagen;
        $rutaImagenNueva = null;


        if ($request->hasFile('imagen')) {

            $imagen = $request->file('imagen');
            $rutaImagenNueva = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images'), $rutaImagenNueva);


            $producto->imagen = $rutaImagenNueva;
        }

        $precioFinal = $request->input('precio_base') * (1 - $request->input('descuento') / 100);



        $producto->nombre = $request->input('nombre');
        $producto->marca = $request->input('marca');
        $producto->ml = $request->input('ml');
        $producto->concentracion = $request->input('concentracion');
        $producto->stock = $request->input('stock');
        $producto->categoria = $request->input('categoria');
        $producto->precio_base = $request->input('precio_base');
        $producto->descuento = $request->input('descuento');
        $producto->precio = $precioFinal;
        $producto->descripcion = $request->input('descripcion');


        $producto->save();


        if ($rutaImagenNueva && $rutaImagenAnterior && file_exists(public_path('images/' . $rutaImagenAnterior))) {
            unlink(public_path('images/' . $rutaImagenAnterior));
        }


        return redirect()->route('admin.productos.index');
    }



    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $rutaImagen = public_path('images/' . $producto->imagen);
        $producto->delete();
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }

        return redirect()->route('admin.productos.index');
    }
}
