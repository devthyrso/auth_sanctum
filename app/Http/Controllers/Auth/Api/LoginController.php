<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            $token = $request->user()->createToken('auth_token')->plainTextToken;
            return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
        }

        return response()->json(['error' => 'Credenciais inválidas'], 401);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
