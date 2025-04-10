<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistema de Empréstimos') }}</title>

    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #007bff;
            padding-top: 60px;
            transition: 0.3s ease-in-out; /* Transição suave */
            z-index: 200;
        }

        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: block;
            transition: 0.3s ease;
            font-weight: bold;
            margin-bottom: 5px; /* Distância entre os links */
        }

        /* Efeito de Hover com animação */
        .sidebar a:hover {
            background-color: #0056b3;
            transform: scale(1.05); /* Efeito de aumento ao passar o mouse */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Sombra no hover */
        }

        .sidebar.active {
            left: 0; /* Aparece quando a sidebar está ativa */
        }

        /* Hamburger */
        #menu-btn {
            position: fixed;
            top: 15px;
            left: 20px;
            font-size: 26px;
            color: white;
            background: none;
            border: none;
            z-index: 300;
            cursor: pointer;
            transition: 0.3s ease;
        }

        #menu-btn:hover {
            color: #0056b3;
            transform: scale(1.1); /* Efeito de aumento no hover */
        }

        /* Top header */
        .top-header {
            background-color: #007bff;
            color: white;
            padding: 15px 0;
            text-align: center;
            position: relative;
            z-index: 100;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .top-header img {
            height: 84px;
            margin-right: 15px; /* Espaço entre logo e nome */
        }

        .titulo-centralizado {
            font-size: 30px;
            font-weight: bold;
            color: white;
            margin-top: 10px;
        }

        /* Conteúdo */
        .content-wrapper {
            padding: 30px 20px;
            margin-left: 0;
            transition: margin-left 0.3s ease-in-out;
            margin-top: 80px; /* Ajusta para a barra de navegação */
            text-align: center; /* Centraliza o conteúdo da página */
        }

        /* Conteúdo se ajusta ao abrir o menu */
        .sidebar.active ~ .content-wrapper {
            margin-left: 250px; /* Quando o menu abre, o conteúdo se ajusta */
        }

        /* Rodapé fixo */
        footer {
            background-color: #007bff;
            color: white;
            padding: 15px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            font-size: 14px;
        }

        /* Tabelas */
        table {
            width: 80%;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            border-radius: 10px; /* Bordas arredondadas */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra na tabela */
        }

        table td {
            text-align: center;
        }

        table thead {
            background-color: #007bff;
            color: white;
        }

        table tbody tr:hover {
            background-color: #f1f1f1; /* Efeito de hover nas linhas da tabela */
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #007bff;
            border: 1px solid #007bff;
            background: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #007bff;
            color: white;
        }

        /* Animações de carregamento */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }

        /* Centralização de conteúdo nas páginas específicas */
        .page-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Botão hamburger -->
    <button id="menu-btn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <a href="{{ route('home.index') }}"><i class="fas fa-home me-2"></i>Inicial</a>
        <a href="{{ route('equipamentos.create') }}"><i class="fas fa-cogs me-2"></i>Cadastrar Equipamento</a>
        <a href="{{ route('usuarios.create') }}"><i class="fas fa-users me-2"></i>Cadastrar Usuário</a>
        <a href="{{ route('emprestimos.create') }}"><i class="fas fa-tools me-2"></i>Cadastrar Empréstimo</a>
        <a href="{{ route('manutencao.create') }}"><i class="fas fa-wrench me-2"></i>Cadastrar Manutenção</a>
        <a href="{{ route('equipamentos.index') }}"><i class="fas fa-cogs me-2"></i>Listar Equipamentos</a>
        <a href="{{ route('usuarios.index') }}"><i class="fas fa-users me-2"></i>Listar Usuários</a>
        <a href="{{ route('emprestimos.index') }}"><i class="fas fa-tools me-2"></i>Listar Empréstimos</a>
        <a href="{{ route('manutencao.index') }}"><i class="fas fa-wrench me-2"></i>Listar Manutenções</a>
        <a href="{{ route('relatorio.index') }}"><i class="fas fa-chart-line me-2"></i>Ver Relatório</a>
        <form action="{{ route('logout') }}" method="POST" class="px-3 mt-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Sair</button>
        </form>
    </div>

    <!-- Top header -->
    <div class="top-header">
        <img src="{{ asset('storage/imagem/logo2.png') }}" alt="Logo">
        <div class="titulo-centralizado">
            Sistema de Empréstimos de Equipamentos
        </div>
    </div>

    <!-- Conteúdo principal -->
    <div class="container page-content">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Script -->
    <script>
        // Toggle da sidebar com animação
        document.getElementById('menu-btn').addEventListener('click', function () {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');

            // Animar conteúdo
            var contentWrapper = document.querySelector('.content-wrapper');
            contentWrapper.style.transition = 'margin-left 0.3s ease-in-out';
            contentWrapper.classList.toggle('shifted');
        });
    </script>

    @yield('scripts')
</body>

</html>
