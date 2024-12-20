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
        
        $request->validate([
            'name' => 'required|string|max:50',
            'apellidos' => 'required|string|max:100',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 50 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.string' => 'Los apellidos deben ser una cadena de texto.',
            'apellidos.max' => 'Los apellidos no deben exceder los 100 caracteres.',
        ]);
    
        $usuario = Auth::user(); 
    
   
        if ($request->filled('password_actual') || $request->filled('password_nueva') || $request->filled('password_nueva_confirmation')) {
    
          
            $request->validate([
                'password_actual' => 'required', 
                'password_nueva' => 'required|string|min:8|max:64|confirmed', 
            ], [
                'password_actual.required' => 'Debe ingresar su contraseña actual.',
                'password_nueva.required' => 'Debe ingresar una nueva contraseña.',
                'password_nueva.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
                'password_nueva.max' => 'La nueva contraseña debe exceder los 64 caracteres.',
                'password_nueva.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
            ]);
    
    
            if (!Hash::check($request->input('password_actual'), $usuario->password)) {
                return redirect()->back()->withErrors(['password_actual' => 'La contraseña actual es incorrecta.']);
            }
    
         
            $usuario->password = Hash::make($request->input('password_nueva'));
            $usuario->save(); 
    
            
            return redirect()->route('miperfil')->with('success', 'Contraseña actualizada con éxito.');
        }
    
        $usuario->name = $request->input('name');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->save(); 
        return redirect()->route('miperfil')->with('success', 'Perfil actualizado con éxito.');
    }
    


public function updateDireccion(Request $request)
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

    
    $direccion = $usuario->direccion;


    $direccion->direccion = $request->input('direccion');
    $direccion->telefono = $request->input('telefono');
    $direccion->ciudad = $request->input('ciudad');
    $direccion->provincia = $request->input('provincia');
    $direccion->cod_postal = $request->input('cod_postal');
    $direccion->pais = $request->input('pais');

    $direccion->save();


    return redirect()->route('midireccion')->with('success', 'La dirección ha sido actualizada correctamente.');
}
   
}
