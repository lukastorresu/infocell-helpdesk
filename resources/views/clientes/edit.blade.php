<x-app-layout>
    <div class="container mx-auto mt-10 p-5">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Editar Cliente</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                    <input type="text" name="nome" id="nome" value="{{ old('nome', $cliente->nome) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="endereco" class="block text-gray-700 text-sm font-bold mb-2">Endereço:</label>
                    <input type="text" name="endereco" id="endereco" value="{{ old('endereco', $cliente->endereco) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="telefone" class="block text-gray-700 text-sm font-bold mb-2">Telefone:</label>
                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $cliente->telefone) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">E-mail (Opcional):</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label for="mal_pagador" class="inline-flex items-center">
                        <input type="checkbox" name="mal_pagador" id="mal_pagador" value="1" {{ old('mal_pagador', $cliente->mal_pagador) ? 'checked' : '' }} class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-red-600 font-bold">Marcar como Mal Pagador</span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Salvar Alterações
                    </button>
                    <a href="{{ url()->previous() }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
