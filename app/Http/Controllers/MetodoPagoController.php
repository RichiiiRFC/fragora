<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoPago;

class MetodoPagoController extends Controller
{

    public function index()
    {
        $metodosPago = MetodoPago::get();
        return view('admin.parametros.metodos_pago.index', compact('metodosPago'));
    }


    public function create()
    {
        return view('admin.parametros.metodos_pago.create');
    }


    public function store(Request $request)
    {
        $metodoPago = new MetodoPago();
        $metodoPago->nombre = $request->nombre;
        $metodoPago->descripcion = $request->descripcion;
        $metodoPago->save();

        return redirect()->route('admin.metodos_pago.index');
    }


    public function show(string $id) {}


    public function edit(string $id)
    {
        $metodoPago = MetodoPago::findOrFail($id);
        return view('admin.parametros.metodos_pago.edit', compact('metodoPago'));
    }


    public function update(Request $request, string $id)
    {
        $metodoPago = MetodoPago::findOrFail($id);
        $metodoPago->nombre = $request->input('nombre');
        $metodoPago->descripcion = $request->input('descripcion');
        $metodoPago->activo = $request->has('activo') ? 1 : 0;

        $metodoPago->save();
        return redirect()->route('admin.metodos_pago.index');
    }


    public function destroy(string $id)
    {
        $metodoPago = MetodoPago::findOrFail($id);
        $metodoPago->delete();
        return redirect()->route('admin.metodos_pago.index');
    }
}
