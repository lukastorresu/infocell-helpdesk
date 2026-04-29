<x-app-layout>
    <x-slot name="title">
        Histórico de Chamados - {{ $cliente->nome }}
    </x-slot>

    <div class="container mx-auto mt-10 p-5">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-700">Histórico de Chamados</h1>
            <p class="text-xl text-gray-500">Cliente: {{ $cliente->nome }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Tipo de Chamado</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/2">Descrição</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Data Abertura</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($chamados as $chamado)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $chamado->id }}</td>
                            <td class="py-3 px-4">{{ $chamado->tipoChamado->nome ?? 'Não especificado' }}</td>
                            <td class="py-3 px-4 text-sm">{{ Str::limit($chamado->descricao, 100) }}</td>
                            <td class="py-3 px-4">{{ $chamado->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-3 px-4">
                                @if($chamado->concluido)
                                    <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Concluído</span>
                                @else
                                    <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Em Aberto</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('chamados.show', $chamado->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Este cliente não possui nenhum chamado registrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            <a href="{{ route('clientes.index') }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600">
                &larr; Voltar para a Lista de Clientes
            </a>
        </div>
    </div>
</x-app-layout>
