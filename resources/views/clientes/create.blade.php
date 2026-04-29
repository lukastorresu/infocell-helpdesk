<x-app-layout>
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-md max-w-lg">
        <h1 class="text-2xl font-bold mb-5 text-gray-700">Cadastrar Novo Cliente</h1>

        <!-- Formulário aponta para a rota 'clientes.store' que criamos com Route::resource -->
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf <!-- Diretiva de segurança OBRIGATÓRIA do Laravel -->

            <div class="mb-4">
                <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome Completo</label>
                <input type="text" id="nome" name="nome" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="telefone" class="block text-gray-700 font-semibold mb-2">Telefone</label>
                <input type="text" id="telefone" name="telefone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">E-mail (Opcional)</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="endereco" class="block text-gray-700 font-semibold mb-2">Endereço</label>
                <input type="text" id="endereco" name="endereco" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                    Salvar Cliente
                </button>
            </div>
        </form>
    </div>
</x-app-layout>