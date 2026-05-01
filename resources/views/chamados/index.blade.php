<x-app-layout>
    <x-slot name="title">
        Lista de Chamados
    </x-slot>

    <div class="container mx-auto mt-10 p-5">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-700">Lista de Chamados</h1>
            <a href="{{ route('chamados.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
                + Abrir Chamado
            </a>
        </div>

        <!-- Barra de Pesquisa e Filtros -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow">
            <form action="{{ route('chamados.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
                    <!-- Filtro por Nome do Cliente -->
                    <div class="md:col-span-2">
                        <label for="search_cliente" class="block text-sm font-medium text-gray-700">Nome do Cliente</label>
                        <input type="text" name="search_cliente" id="search_cliente" placeholder="Digite o nome..." value="{{ request('search_cliente') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Filtro por Tipo de Chamado -->
                    <div>
                        <label for="search_tipo" class="block text-sm font-medium text-gray-700">Tipo de Chamado</label>
                        <select name="search_tipo" id="search_tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Todos</option>
                            @foreach($tiposChamado as $tipo)
                            <option value="{{ $tipo->id }}" @selected(request('search_tipo')==$tipo->id)>{{ $tipo->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Técnico -->
                    <div>
                        <label for="search_tecnico" class="block text-sm font-medium text-gray-700">Técnico</label>
                        <select name="search_tecnico" id="search_tecnico" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Todos</option>
                            @foreach($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id }}" @selected(request('search_tecnico')==$tecnico->id)>{{ $tecnico->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Status -->
                    <div>
                        <label for="search_status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="search_status" id="search_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Todos</option>
                            <option value="aberto" @selected(request('search_status')==='aberto' )>Em Aberto</option>
                            <option value="cancelado" @selected(request('search_status')==='cancelado' )>Cancelado</option>
                            <option value="concluido" @selected(request('search_status')==='concluido' )>Concluído</option>
                        </select>
                    </div>

                    <!-- Filtro por Data Inicial e Final -->
                    <div>
                        <label for="search_date_start" class="block text-sm font-medium text-gray-700">Data Inicial</label>
                        <input type="date" name="search_date_start" id="search_date_start" value="{{ request('search_date_start') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="search_date_end" class="block text-sm font-medium text-gray-700">Data Final</label>
                        <input type="date" name="search_date_end" id="search_date_end" value="{{ request('search_date_end') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Botões -->
                    <div class="md:col-span-6 flex items-center space-x-2 mt-4">
                        <button type="submit" class="w-full justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Filtrar
                        </button>
                        <a href="{{ route('chamados.index') }}" class="w-full text-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Limpar
                        </a>
                    </div>
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
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nº</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Cliente</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Tipo</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Técnico</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Data e Hora</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($chamados as $chamado)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-4">{{ $chamado->id }}</td>
                        <td class="py-3 px-4">{{ $chamado->cliente->nome }}</td>
                        <td class="py-3 px-4">{{ $chamado->tipoChamado->nome }}</td>
                        <td class="py-3 px-4">{{ $chamado->tecnico->nome }}</td>
                        <td class="py-3 px-4">{{ $chamado->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3 px-4">
                            @if($chamado->status === 'concluido')
                            <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Concluído</span>
                            @elseif($chamado->status === 'cancelado')
                            <span class="bg-red-200 text-green-800 py-1 px-3 rounded-full text-xs">Cancelado</span>
                            @else
                            <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Em Aberto</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('chamados.show', $chamado->id) }}" class="text-blue-500 hover:text-blue-700">Ver</a>
                                <a href="{{ route('chamados.edit', $chamado->id) }}" class="text-yellow-500 hover:text-yellow-700">Editar</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Nenhum chamado encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $chamados->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>