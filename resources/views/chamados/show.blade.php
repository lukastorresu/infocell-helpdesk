<x-app-layout>
    <x-slot name="title">
        Detalhes do Chamado #{{ $chamado->id }}
    </x-slot>

    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-md max-w-2xl">
        <div class="border-b pb-4 mb-4">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Chamado #{{ $chamado->id }}</h1>
                    <p class="text-sm text-gray-500">Aberto em: {{ $chamado->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    @if($chamado->status === 'concluido')
                    <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-sm font-semibold">Concluído</span>
                    @elseif($chamado->status === 'cancelado')
                    <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-sm font-semibold">Cancelado</span>
                    @else
                    <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-sm font-semibold">Em Aberto</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-lg">
            <div>
                <h2 class="text-gray-500 font-semibold">Cliente</h2>
                <p class="text-gray-800">{{ $chamado->cliente->nome }}</p>
            </div>
            <div>
                <h2 class="text-gray-500 font-semibold">Técnico Responsável</h2>
                <p class="text-gray-800">{{ $chamado->tecnico->nome }}</p>
            </div>
            <div>
                <h2 class="text-gray-500 font-semibold">Tipo de Chamado</h2>
                <p class="text-gray-800">{{ $chamado->tipoChamado->nome }}</p>
            </div>
            <!-- Valor Total Adicionado -->
            <div>
                <h2 class="text-gray-500 font-semibold">Valor Total</h2>
                <p class="text-gray-800 font-bold">{{ $chamado->valor_total ? 'R$ ' . number_format($chamado->valor_total, 2, ',', '.') : 'Não definido' }}</p>
            </div>
            <div class="md:col-span-2">
                <h2 class="text-gray-500 font-semibold">Descrição do Problema</h2>
                <p class="text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $chamado->descricao }}</p>
            </div>
        </div>

        <div class="mt-6 border-t pt-4 flex justify-between items-center">
            <a href="{{ url()->previous() }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600">
                &larr; Voltar
            </a>

            <!-- Botão para Gerar PDF (visível apenas se o chamado estiver concluído) -->
            @if($chamado->status === 'concluido')
            <a href="{{ route('chamados.pdf', $chamado->id) }}" target="_blank" class="bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700">
                Gerar PDF
            </a>
            @endif
        </div>
    </div>
</x-app-layout>