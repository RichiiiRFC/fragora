<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direccion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BienvenidaNotification;


class LoginController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:64|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 50 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.string' => 'Los apellidos deben ser una cadena de texto.',
            'apellidos.max' => 'Los apellidos no deben exceder los 100 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes proporcionar una dirección de correo válida.',
            'email.max' => 'El correo electrónico no debe exceder los 100 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no debe exeder los 64 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);


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

        Auth::login($user);

        $user->notify(new BienvenidaNotification());


        return redirect()->intended(route('miperfil'))->with('status', 'Te has registrado correctamente. ¡Bienvenido!');
    }




    public function login(Request $request)
{
    
    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        return redirect()->intended(route('inicio'));
    } else {
        return redirect()->route('login')->with('error', 'Credenciales incorrectas.');
    }
}



    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }
}
