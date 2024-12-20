<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoEnvio;

class MetodoEnvioController extends Controller
{

    public function index()
    {
        $metodosEnvio = MetodoEnvio::get();
        return view('admin.parametros.metodos_envio.index', compact('metodosEnvio'));
    }


    public function create()
    {
        return view('admin.parametros.metodos_envio.create');
    }


    public function store(Request $request)
    {
        $metodoEnvio = new MetodoEnvio();
        $metodoEnvio->nombre = $request->nombre;
        $metodoEnvio->descripcion = $request->descripcion;
        $metodoEnvio->costo = $request->costo;
        $metodoEnvio->save();

        return redirect()->route('admin.metodos_envio.index');
    }


    public function show(string $id) {}


    public function edit(string $id)
    {
        $metodoEnvio = MetodoEnvio::findOrFail($id);
        return view('admin.parametros.metodos_envio.edit', compact('metodoEnvio'));
    }


    public function update(Request $request, string $id)
    {
        $metodoEnvio = MetodoEnvio::findOrFail($id);
        $metodoEnvio->nombre = $request->input('nombre');
        $metodoEnvio->descripcion = $request->input('descripcion');
        $metodoEnvio->costo = $request->input('costo');
        $metodoEnvio->activo = $request->has('activo') ? 1 : 0;

        $metodoEnvio->save();
        return redirect()->route('admin.metodos_envio.index');
    }


    public function destroy(string $id)
    {
        $metodoEnvio = MetodoEnvio::findOrFail($id);
        $metodoEnvio->delete();
        return redirect()->route('admin.metodos_envio.index');
    }
}
