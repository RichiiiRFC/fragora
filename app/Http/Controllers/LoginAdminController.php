<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    


 public function login(Request $request)
{
    $credentials = [
        "email" => $request->email,
        "password" => $request->password, 
    ];

    $user = User::where('email', $request->email)->first(); 

    if ($user) {
        if ($user->rol === 'admin' && Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.inicio'));
        } else {
            return redirect()->route('admin-login')->with('error', 'Solo los administradores pueden iniciar sesión.');
        }
    } else {
        return redirect()->route('admin-login')->with('error', 'Credenciales incorrectas.');
    }
}



 public function logout(Request $request){

        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin-login');
    }


}
