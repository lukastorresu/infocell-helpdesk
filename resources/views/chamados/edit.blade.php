<x-app-layout>
    <x-slot name="title">
        Editar Chamado #{{ $chamado->id }}
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-md max-w-2xl">
        <h1 class="text-2xl font-bold mb-5 text-gray-700">Editar Chamado #{{ $chamado->id }}</h1>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Opa! Algo deu errado.</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('chamados.update', $chamado->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="cliente_id" class="block text-gray-700 font-semibold mb-2">Cliente</label>
                    <select name="cliente_id" id="select-cliente" class="w-full" required>
                        <option value="{{ $chamado->cliente->id }}">{{ $chamado->cliente->nome }}</option>
                    </select>
                </div>
                <div>
                    <label for="tecnico_id" class="block text-gray-700 font-semibold mb-2">Técnico</label>
                    <select name="tecnico_id" id="tecnico_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        @foreach ($tecnicos as $tecnico)
                        <option value="{{ $tecnico->id }}" @selected(old('tecnico_id', $chamado->user_id) == $tecnico->id)>{{ $tecnico->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label for="tipo_id" class="block text-gray-700 font-semibold mb-2">Tipo de Chamado</label>
                <select name="tipo_id" id="tipo_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                    @foreach ($tiposChamado as $tipo)
                    <option value="{{ $tipo->id }}" @selected($chamado->tipo_id == $tipo->id)>{{ $tipo->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="descricao" class="block text-gray-700 font-semibold mb-2">Descrição</label>
                <textarea name="descricao" id="descricao" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>{{ $chamado->descricao }}</textarea>
            </div>

            <div class="my-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status do Chamado</label>
                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="aberto" {{ (old('status', $chamado->status) == 'aberto') ? 'selected' : '' }}>Em Aberto</option>
                    <option value="cancelado" {{ (old('status', $chamado->status) == 'cancelado') ? 'selected' : '' }}>Cancelado</option>
                    <option value="concluido" {{ (old('status', $chamado->status) == 'concluido') ? 'selected' : '' }}>Concluído</option>
                </select>
            </div>

            <div id="div-conclusao" class="grid grid-cols-1 md:grid-cols-2 gap-6" style="display: none;">
                <div id="div-valor">
                    <label for="valor_total" class="block text-sm font-medium text-gray-700">Valor Total (R$)</label>
                    <input type="text" name="valor_total" id="valor_total" value="{{ old('valor_total', $chamado->valor_total) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <div id="div-pagamento">
                    <label for="forma_pagamento" class="block text-sm font-medium text-gray-700">Forma de Pagamento</label>
                    <select id="forma_pagamento" name="forma_pagamento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecione...</option>
                        <option value="Pix" {{ (old('forma_pagamento', $chamado->forma_pagamento) == 'Pix') ? 'selected' : '' }}>Pix</option>
                        <option value="Cartão" {{ (old('forma_pagamento', $chamado->forma_pagamento) == 'Cartão') ? 'selected' : '' }}>Cartão</option>
                        <option value="Dinheiro" {{ (old('forma_pagamento', $chamado->forma_pagamento) == 'Dinheiro') ? 'selected' : '' }}>Dinheiro</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Atualizar Chamado
                </button>
                <a href="{{ route('chamados.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-900">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#select-cliente', {
                valueField: 'id',
                labelField: 'text',
                searchField: 'text',
                create: false,
                load: function(query, callback) {
                    if (!query.length) return callback();
                    const url = `{{ route('clientes.search') }}?q=${encodeURIComponent(query)}`;
                    fetch(url)
                        .then(response => response.json())
                        .then(json => {
                            callback(json);
                        }).catch(() => {
                            callback();
                        });
                }
            });

            const statusSelect = document.getElementById('status');
            const divConclusao = document.getElementById('div-conclusao');
            const inputValor = document.getElementById('valor_total');
            const selectPagamento = document.getElementById('forma_pagamento');

            function toggleConclusaoVisibility() {
                if (statusSelect.value === 'concluido') {
                    divConclusao.style.display = 'grid'; 
                } else {
                    divConclusao.style.display = 'none';
                    inputValor.value = '';
                    selectPagamento.value = ''; 
                }
            }

            toggleConclusaoVisibility();

            statusSelect.addEventListener('change', toggleConclusaoVisibility);
        });
    </script>
</x-app-layout>