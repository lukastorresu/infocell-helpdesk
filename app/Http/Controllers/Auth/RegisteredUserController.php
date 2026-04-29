<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tecnico;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Tecnico::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $tecnico = Tecnico::create([
            'nome' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        event(new Registered($tecnico));

        // A linha abaixo foi DESATIVADA para impedir o login automático.
        // Auth::login($tecnico); 

        // Redireciona para a rota de login com uma mensagem de sucesso.
        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Agora você pode fazer o login.');
    }
}
