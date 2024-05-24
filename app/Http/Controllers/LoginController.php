<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direccion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  
    public function register(Request $request)
    {
        $userExiste = User::where('email', $request->email)->first();
    if ($userExiste) {
        return redirect()->back()->with('error', 'Este usuario ya existe.');
    }

        $user = new User();
        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->rol = "cliente";
        $user->password = Hash::make($request->password);
        $user->save();

        
        $direccion = new Direccion();
        $direccion->user_id = $user->id; 
        $direccion->save();

       
        return redirect()->route('login')->with('status', 'Te has registrado correctamente. Por favor, inicia sesión.');
    }



    
    public function login(Request $request){

        $credentials = [
            "email" => $request->email,
            "password" => $request->password, 
        ];

        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials, $remember)){
           
            $request->session()->regenerate();
            // Redirigimos al usuario a la URL que intentaba acceder antes
            return redirect()->intended(route('inicio'));
        }else{
            return redirect()->route('login')->with('error', 'Credenciales incorrectas.');
        }
    }

 
    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }

}
