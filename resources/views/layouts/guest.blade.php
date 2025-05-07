<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-blue-50">

    <!-- Cabeçalho -->
    <div class="bg-blue-600 text-white text-center py-6 shadow-xl">
        <h1 class="text-3xl font-semibold">Sistema de Gestão de Empréstimos de Equipamentos</h1>
        <p class="text-lg mt-2">Gerencie seus empréstimos de forma rápida e fácil</p>
    </div>

    <!-- Conteúdo -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <!-- Estilos personalizados -->
    <style>
    /* Cor de fundo principal */
    body {
        background-color: #ebf8ff; /* Azul claro */
        font-family: 'Figtree', sans-serif;
    }

    /* Cabeçalho estilizado */
    .bg-blue-600 {
        background-color: #3182ce !important; /* Azul vibrante */
        color: white !important;
        padding: 12px 20px;
        border: none;
        width: auto; /* Para não ocupar toda a largura */

        text-align: center;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .bg-blue-600:hover {
        background-color: #3182ce !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Texto do cabeçalho */
    h1 {
        font-size: 2rem;
        font-weight: bold;
    }

    p {
        font-size: 1rem;
    }

    /* Estilo do conteúdo */
    .w-full {
        width: 100%;
    }

    .sm\:max-w-md {
        max-width: 500px;
    }

    /* Card de formulário */
    .bg-white {
        background-color: rgb(255, 255, 255);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        border-radius: 16px;
        transition: box-shadow 0.3s ease;
    }

    .bg-white:hover {
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    /* Campos de entrada */
    input[type="text"], input[type="email"], input[type="password"] {
        background-color: #edf2f7;
        border: 1px solid #cbd5e0;
        padding: 12px 16px;
        width: 100%;
        font-size: 1rem;
        margin-top: 8px;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        color: #2d3748;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #3182ce;
        outline: none;
        box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.3);
    }

    /* Labels e textos */
    label {
        font-size: 1rem;
        font-weight: bold;
        color: #2d3748;
    }

    .text-black {
        color: #333;
    }

    .text-lg {
        font-size: 1.125rem;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    /* Links e interação */
    .hover\:underline:hover {
        text-decoration: underline;
    }

    /* Efeito de transição suave nos inputs e botões */
    .transition-all {
        transition: all 0.3s ease;
    }

    /* Estilo para o checkbox "Lembrar-me" */
    .flex.items-center {
        align-items: center;
    }

    /* Ajustes de fundo */
    .bg-blue-50 {
        background-color: #ebf8ff;
    }

    .shadow-lg {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .rounded-lg {
        border-radius: 16px;
    }
</style>

</body>
</html>
