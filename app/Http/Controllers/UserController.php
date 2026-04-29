<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = Tecnico::where('role', 'tecnico')->paginate(10);
        // Caminho da view alterado para 'usuarios.index'
        return view('usuarios.index', compact('users'));
    }

    public function edit(Tecnico $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    public function update(Request $request, Tecnico $user)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->nome = $request->nome;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(Tecnico $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Não é possível excluir um administrador.');
        }
        
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
