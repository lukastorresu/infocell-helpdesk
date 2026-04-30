<x-guest-layout>
    <x-slot name="title">
        Login
    </x-slot>

    <!-- Exibe a mensagem de sucesso após o cadastro -->
    @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <!-- Exibe erros de validação -->
    @if ($errors->any())
        <div class="mb-4">
            <div class="font-medium text-red-600">Opa! Algo deu errado.</div>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div>
            <label for="email" class="text-sm font-bold text-gray-600 block">E-mail</label>
            <input id="email" name="email" type="email" class="w-full p-2 border border-gray-300 rounded mt-1" required autofocus />
        </div>
        <div>
            <label for="password" class="text-sm font-bold text-gray-600 block">Senha</label>
            <input id="password" name="password" type="password" class="w-full p-2 border border-gray-300 rounded mt-1" required />
        </div>
        <div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded-md text-white text-sm">Entrar</button>
        </div>
    </form>
</x-guest-layout>
