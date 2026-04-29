<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('perfil.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', Password::min(8)->letters()->numbers(), 'confirmed'],
        ], [
            'current_password.required' => 'O campo de senha atual é obrigatório.',
            'password.required' => 'O campo de nova senha é obrigatório.',
            'password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da nova senha não corresponde.',
            'password.letters' => 'A nova senha deve conter letras.',
            'password.numbers' => 'A nova senha deve conter números.',
        ]);

        // Verifica se a senha atual informada está correta
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => __('A senha atual informada está incorreta.'),
            ]);
        }

        // Atualiza a senha
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('perfil.edit')->with('success', 'Senha alterada com sucesso!');
    }
}
