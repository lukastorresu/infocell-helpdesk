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
                            <option value="{{ $tecnico->id }}" @selected($chamado->tecnico_id == $tecnico->id)>{{ $tecnico->nome }}</option>
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

            <div class="mt-4">
                <label for="concluido" class="flex items-center">
                    <!-- Adiciona um campo oculto para garantir que um valor (0 ou 1) seja sempre enviado -->
                    <input type="hidden" name="concluido" value="0">
                    <input type="checkbox" name="concluido" id="concluido" value="1" @checked(old('concluido', $chamado->concluido)) class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <span class="ml-2 text-gray-700">Marcar como Concluído</span>
                </label>
            </div>

            <!-- Campo de Valor Total, controlado por JavaScript -->
            <div class="mt-4" id="valor-total-container" style="display: {{ $chamado->concluido || old('concluido') ? 'block' : 'none' }};">
                <label for="valor_total" class="block text-gray-700 font-semibold mb-2">Valor Total (R$)</label>
                <input type="text" name="valor_total" id="valor_total" value="{{ old('valor_total', $chamado->valor_total ? number_format($chamado->valor_total, 2, ',', '.') : '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Ex: 150,00">
            </div>

            <div class="mt-6 flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
                    Atualizar Chamado
                </button>
                <a href="{{ route('chamados.index') }}" class="text-gray-600 hover:text-gray-800">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script do Tom Select para busca de cliente
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

            // Script para mostrar/ocultar o campo de valor
            const concluidoCheckbox = document.getElementById('concluido');
            const valorContainer = document.getElementById('valor-total-container');
            const valorInput = document.getElementById('valor_total');

            concluidoCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    valorContainer.style.display = 'block';
                } else {
                    valorContainer.style.display = 'none';
                    valorInput.value = ''; // Limpa o valor se desmarcar
                }
            });
        });
    </script>
</x-app-layout>
