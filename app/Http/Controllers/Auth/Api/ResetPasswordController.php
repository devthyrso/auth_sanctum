<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return response()->json(['message' => 'Senha redefinida com sucesso!'], 200);
            } else {
                Log::error('Falha ao redefinir a senha: ', ['status' => $status]);
                return response()->json(['message' => 'Erro ao redefinir a senha.'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Erro ao redefinir a senha: ' . $e->getMessage());

            return response()->json(['message' => 'Erro ao redefinir a senha.'], 500);
        }
    }
}
