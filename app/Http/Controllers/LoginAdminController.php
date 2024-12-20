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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->rol === 'admin') {

                $request->session()->regenerate();

                return redirect()->intended(route('admin.inicio'));
            } else {
                Auth::logout();
                return redirect()->route('admin-login')->with('error', 'Solo los administradores pueden iniciar sesión.');
            }
        } else {

            return redirect()->route('admin-login')->with('error', 'Credenciales incorrectas.');
        }
    }




    public function logout(Request $request)
    {


        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin-login');
    }
}
