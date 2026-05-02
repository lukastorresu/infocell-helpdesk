<x-app-layout>
    <x-slot name="title">
        Painel de Controle
    </x-slot>

    <div class="container mx-auto px-6 py-12">
        <h2 class="text-3xl font-light text-gray-700 mb-8">Painel de Controle</h2>

        <!-- Cards de Resumo Interativos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Card de Chamados Abertos Hoje -->
            <a href="{{ route('chamados.index', ['search_date_start' => $hoje, 'search_date_end' => $hoje]) }}" class="block bg-white p-6 rounded-lg shadow-lg transform transition-transform duration-300 hover:scale-105">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 text-lg">Chamados Abertos Hoje</h3>
                        <p class="text-4xl font-bold text-blue-600">{{ $chamadosAbertosHoje }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M12 12.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                </div>
            </a>
            <!-- Card de Chamados Concluídos na Semana -->
            <a href="{{ route('chamados.index', ['search_status' => 'concluido', 'search_date_start' => $inicioSemana, 'search_date_end' => $fimSemana]) }}" class="block bg-white p-6 rounded-lg shadow-lg transform transition-transform duration-300 hover:scale-105">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 text-lg">Concluídos na Semana</h3>
                        <p class="text-4xl font-bold text-green-600">{{ $chamadosConcluidosSemana }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </a>
            <!-- Card Faturamento da Semana -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 text-lg">Faturamento da Semana</h3>
                        <p class="text-4xl font-bold text-indigo-600">R$ {{ number_format($faturamentoSemana, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <!-- Card Faturamento do Mês -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 text-lg">Faturamento do Mês</h3>
                        <p class="text-4xl font-bold text-purple-600">R$ {{ number_format($faturamentoMes, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção do Gráfico e Blocos de Navegação -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Gráfico de Pizza -->
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Tipos de Serviço Mais Comuns (Mês)</h3>
                <div class="relative h-96">
                    <canvas id="tiposServicoChart"></canvas>
                </div>
            </div>

            <!-- Blocos de Navegação com Ícones -->
            <div class="space-y-8">
                <a href="{{ route('clientes.index') }}" class="block p-8 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 ease-in-out">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Gerenciar Clientes</h3>
                            <p class="text-gray-600">Acesse a lista, cadastre novos clientes e consulte o histórico.</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="{{ route('tipos-chamado.index') }}" class="block p-8 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 ease-in-out">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Tipos de Chamado</h3>
                            <p class="text-gray-600">Crie e edite as categorias dos serviços.</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 8v5c0 1.1.9 2 2 2h.5a.5.5 0 00.5-.5v-2a.5.5 0 00-.5-.5H5a2 2 0 01-2-2v-5a2 2 0 01.586-1.414l7-7z" />
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="{{ route('chamados.index') }}" class="block p-8 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 ease-in-out">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Administrar Chamados</h3>
                            <p class="text-gray-600">Abra novos chamados e acompanhe o status.</p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Adiciona o script do Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Recebe o array de faturamentos do PHP
            const faturamentosPhp = @json($chartFaturamento);

            const ctx = document.getElementById('tiposServicoChart').getContext('2d');
            const tiposServicoChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Chamados Concluídos',
                        data: @json($chartData),
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 255, 255, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Distribuição de Tipos de Serviço'
                        },
                        // Customizando a caixinha de hover (Tooltip)
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let index = context.dataIndex;
                                    let qtd = context.raw; // Quantidade de chamados
                                    let valor = faturamentosPhp[index] || 0; // Faturamento da fatia
                                    
                                    // Formata o valor em R$
                                    let valorFormatado = new Intl.NumberFormat('pt-BR', { 
                                        style: 'currency', 
                                        currency: 'BRL' 
                                    }).format(valor);

                                    // Retorna um array com duas strings para criar linhas separadas
                                    return [
                                        ` Chamados Concluídos: ${qtd}`,
                                        ` Faturamento: ${valorFormatado}`
                                    ];
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
