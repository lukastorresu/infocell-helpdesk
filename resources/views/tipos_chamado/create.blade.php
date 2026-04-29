<x-app-layout>
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-md max-w-lg">
        <h1 class="text-2xl font-bold mb-5 text-gray-700">Cadastrar Novo Tipo de Chamado</h1>

        <form action="{{ route('tipos-chamado.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome do Tipo</label>
                <input type="text" id="nome" name="nome" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="descricao" class="block text-gray-700 font-semibold mb-2">Descrição (Opcional)</label>
                <input type="text" id="descricao" name="descricao" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
                    Salvar
                </button>
                <a href="{{ route('tipos-chamado.index') }}" class="text-gray-600 hover:text-gray-800">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>