<x-guest-layout>
    <x-slot name="title">
        Cadastro de Técnico
    </x-slot>

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

    <form method="POST" action="{{ route('register') }}" class="space-y-4" autocomplete="off">
        @csrf
        <div>
            <label for="name" class="text-sm font-bold text-gray-600 block">Nome do Técnico</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" class="w-full p-2 border border-gray-300 rounded mt-1" required autofocus />
        </div>
        <div>
            <label for="email" class="text-sm font-bold text-gray-600 block">E-mail</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full p-2 border border-gray-300 rounded mt-1" required />
        </div>
        <div>
            <label for="password" class="text-sm font-bold text-gray-600 block">Senha</label>
            <input id="password" name="password" type="password" class="w-full p-2 border border-gray-300 rounded mt-1" required autocomplete="new-password" />
        </div>
        <div>
            <label for="password_confirmation" class="text-sm font-bold text-gray-600 block">Confirmar Senha</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full p-2 border border-gray-300 rounded mt-1" required autocomplete="new-password" />
        </div>
        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Já possui uma conta?</a>
            <button type="submit" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded-md text-white">Cadastrar</button>
        </div>
    </form>
</x-guest-layout>
