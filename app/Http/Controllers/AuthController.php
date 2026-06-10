<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('login.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {

            $request->session()->regenerate();

            return response()->json([
                'status' => true,
                'message' => 'Login efetuado com sucesso',
                'redirect' => url('/dashboard'),
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Email ou senha inválidos',
        ]);
    }

    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
