<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direccion;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::get();
        return view('admin.usuarios.index', compact('usuarios'));
    }


    public function create() {}


    public function store(Request $request) {}


    public function show(string $id) {}


    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);


        $usuario->name = $request->input('name');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->rol = $request->input('rol');


        $usuario->save();


        $direccion = $usuario->direccion;


        if (!$direccion) {
            $direccion = new Direccion();
            $direccion->user_id = $usuario->id;
        }


        $direccion->direccion = $request->input('direccion');
        $direccion->telefono = $request->input('telefono');
        $direccion->ciudad = $request->input('ciudad');
        $direccion->provincia = $request->input('provincia');
        $direccion->cod_postal = $request->input('cod_postal');
        $direccion->pais = $request->input('pais');


        $direccion->save();

        return redirect()->route('admin.usuarios.index');
    }



    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios.index');
    }
}
