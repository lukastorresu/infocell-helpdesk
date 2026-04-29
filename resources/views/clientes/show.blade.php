<x-app-layout>
    <div class="container mx-auto mt-10 p-5">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $cliente->nome }}</h1>
                    <p class="text-gray-500">{{ $cliente->email ?? 'E-mail não informado' }}</p>
                </div>
                <div>
                    @if ($cliente->mal_pagador)
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            Mal Pagador
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            Bom Pagador
                        </span>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Telefone</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $cliente->telefone }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Endereço</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $cliente->endereco }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Histórico de Chamados -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Histórico de Chamados</h2>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">#ID</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Tipo de Serviço</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Data de Abertura</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($cliente->chamados as $chamado)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $chamado->id }}</td>
                            <td class="py-3 px-4">{{ $chamado->tipoChamado->nome }}</td>
                            <td class="py-3 px-4">{{ $chamado->created_at->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">
                                @if ($chamado->concluido)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Concluído
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Em Aberto
                                </span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('chamados.show', $chamado->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Ver</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Nenhum chamado registrado para este cliente.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

         <div class="mt-6">
            <a href="{{ url()->previous() }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600">
                &larr; Voltar
            </a>
        </div>
    </div>
</x-app-layout>
