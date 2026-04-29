<x-app-layout>
    <x-slot name="title">
        Abrir Novo Chamado
    </x-slot>

    <!-- Adiciona o CSS do Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-md max-w-2xl">
        <h1 class="text-2xl font-bold mb-5 text-gray-700">Abrir Novo Chamado</h1>

        <form action="{{ route('chamados.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="cliente_id" class="block text-gray-700 font-semibold mb-2">Cliente</label>
                    <select name="cliente_id" id="select-cliente" placeholder="Digite para buscar um cliente..." class="w-full" required></select>
                </div>
                <div>
                    <label for="tecnico_id" class="block text-gray-700 font-semibold mb-2">Técnico Responsável</label>
                    <select name="tecnico_id" id="tecnico_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        <option value="">Selecione um técnico</option>
                        @foreach ($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id }}">{{ $tecnico->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label for="tipo_id" class="block text-gray-700 font-semibold mb-2">Tipo de Chamado</label>
                <select name="tipo_id" id="tipo_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                    <option value="">Selecione o tipo</option>
                    @foreach ($tiposChamado as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="descricao" class="block text-gray-700 font-semibold mb-2">Descrição do Problema</label>
                <textarea name="descricao" id="descricao" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></textarea>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
                    Abrir Chamado
                </button>
                <a href="{{ route('chamados.index') }}" class="text-gray-600 hover:text-gray-800">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Adiciona o JS do Tom Select e o script de inicialização -->
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
        });
    </script>
</x-app-layout>
