<header class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Título agora é um link para o dashboard com animação -->
        <a href="{{ route('dashboard') }}" class="transform transition-transform duration-300 hover:scale-105">
            <h1 class="text-2xl font-bold text-gray-800">InfoCell <span class="text-blue-600">HelpDesk</span></h1>
        </a>
        
        <div class="flex items-center space-x-8">
            <nav class="space-x-4 text-gray-600 font-semibold hidden md:flex">
                <a href="{{ route('clientes.index') }}" class="hover:text-blue-600">Clientes</a>
                <a href="{{ route('tipos-chamado.index') }}" class="hover:text-blue-600">Tipos de Chamado</a>
                <a href="{{ route('chamados.index') }}" class="hover:text-blue-600">Chamados</a>
				@if(auth()->user()->role === 'admin')
				<a href="/usuarios">Gerenciar Usuários</a>
				@endif
            </nav>

            <div class="flex items-center space-x-4 border-l pl-6">
                @auth
                    <!-- Nome do usuário agora é um link para o perfil -->
                    <a href="{{ route('perfil.edit') }}" class="text-gray-700 hover:text-blue-600">
                        @if(auth()->user()->role === 'admin')
                            Admin:
                        @else
                            Técnico:
                        @endif
                        <strong>{{ Auth::user()->nome }}</strong>
                    </a>
                    
                    <!-- Formulário de Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-red-500 hover:text-red-700 font-semibold">
                            Sair
                        </a>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>
