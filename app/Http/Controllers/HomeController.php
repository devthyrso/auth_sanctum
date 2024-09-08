<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Atualiza os dados do usuário
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'rua' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|min:8|max:9',
        ]);

        $user->update($request->all());

        return response()->json($user);
    }

    // Exclui um usuário
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json($user);
    }
}