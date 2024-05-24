<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direccion;
use App\Models\Producto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ClienteController extends Controller
{


    public function updatePerfil(Request $request)
    {
        $usuario = Auth::user();
        $usuario->name = $request->input('name');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->save();

        return redirect()->route('miperfil');
    }


   public function updateDireccion(Request $request)
{
    $usuario = Auth::user();

    $direccion = $usuario->direccion;

    $direccion->direccion = $request->input('direccion');
    $direccion->telefono = $request->input('telefono');
    $direccion->ciudad = $request->input('ciudad');
    $direccion->provincia = $request->input('provincia');
    $direccion->cod_postal = $request->input('cod_postal');
    $direccion->pais = $request->input('pais');

   
    $direccion->save();

    return redirect()->route('midireccion');
}


    
    
}
