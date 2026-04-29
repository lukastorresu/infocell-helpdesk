<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- O título será dinâmico para cada página -->
    <title>{{ $title ?? 'InfoCell HelpDesk' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="bg-gray-100">

    <!-- Inclui a nossa barra de navegação -->
    @include('layouts.navigation')

    <!-- Conteúdo Principal -->
    <main>
        {{ $slot }}
    </main>
</body>
</html>
