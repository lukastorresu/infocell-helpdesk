<x-app-layout>
    <x-slot name="title">
        Lista de Clientes
    </x-slot>

    <div class="container mx-auto mt-10 p-5">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-700">Lista de Clientes</h1>
            <a href="{{ route('clientes.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                + Novo Cliente
            </a>
        </div>

        <div class="mb-6">
            <form action="{{ route('clientes.index') }}" method="GET">
                <div class="flex">
                    <input type="text" name="search" placeholder="Pesquisar por nome..." value="{{ request('search') }}" class="w-full px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:border-blue-500">
                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-r-lg hover:bg-blue-600">
                        Pesquisar
                    </button>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nome</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Telefone</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">E-mail</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Endereço</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($clientes as $cliente)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $cliente->nome }}</td>
                            <td class="py-3 px-4">{{ $cliente->telefone }}</td>
                            <td class="py-3 px-4">{{ $cliente->email ?? 'Não informado' }}</td>
                            <td class="py-3 px-4">{{ $cliente->endereco }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('clientes.show', $cliente->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">Ver</a>
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-yellow-500 hover:text-yellow-700 font-semibold">Editar</a>
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                Nenhum cliente encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $clientes->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>
