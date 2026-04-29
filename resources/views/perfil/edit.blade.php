<x-app-layout>
    <div class="container mx-auto mt-10 p-5">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-700 mb-6">Meu Perfil</h1>

            <!-- Mensagem de Sucesso -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('perfil.update') }}">
                @csrf
                @method('patch')

                <!-- Campo Nome (Apenas Leitura) -->
                <div class="mb-4">
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input id="nome" type="text" value="{{ $user->nome }}" disabled
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200">
                </div>

                <!-- Campo Email (Apenas Leitura) -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" value="{{ $user->email }}" disabled
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200">
                </div>

                <hr class="my-6">

                <h2 class="text-xl font-bold text-gray-700 mb-4">Alterar Senha</h2>

                <!-- Senha Atual -->
                <div class="mb-4">
                    <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Senha Atual</label>
                    <input id="current_password" name="current_password" type="password" required autocomplete="current-password"
                           class="shadow appearance-none border @error('current_password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('current_password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nova Senha -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Nova Senha</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                           class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                     @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmar Nova Senha -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirmar Nova Senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
