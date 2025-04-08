<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistema de Empréstimos') }}</title>

    <!-- Fontes Modernas (Poppins ou Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Carregar o Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Usando fontes mais modernas */
        body {
            font-family: 'Inter', sans-serif;
            margin-bottom: 80px; /* Espaço para o rodapé fixo */
        }

        .navbar {
            background-color: #007bff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }

        /* Cartões com bordas arredondadas e sombra suave */
        .card {
            border-radius: 15px;
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 2rem;
        }

        .btn-primary, .btn-secondary {
            border-radius: 30px;
            font-size: 16px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .icon-card {
            font-size: 55px;
            color: #007bff;
            transition: transform 0.3s ease;
        }

        .icon-card:hover {
            transform: scale(1.15);
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
            /* Garantir que o rodapé não sobreponha o conteúdo */
            margin-top: 10px;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Melhorar a visibilidade dos links no menu de navegação */
        .navbar-nav .nav-item {
            margin-left: 15px;
        }

        /* Estilo para o botão de sair */
        .btnSair {
            position: absolute;
            right: 20px;
            top: 15px;
        }

        .btnSair button {
            border-radius: 25px;
            font-size: 14px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }

        .btnSair button:hover {
            background-color: #dc3545;
        }

        /* Estilo para a logomarca na barra de navegação */
        .navbar-brand img {
            height: 50px; /* Ajuste o tamanho conforme necessário */
            width: auto;
        }

        /* Ajuste de layout para garantir que o conteúdo não fique atrás do rodapé */
        .content-wrapper {
            padding-bottom: 80px; /* Espaço para o rodapé fixo */
        }

        /* Estilo do botão "Inicial" */
        .nav-item .nav-link {
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        /* Estilo do botão "Inicial" ao passar o mouse */
        .nav-item .nav-link:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }

    </style>
</head>
<body class="bg-light">

    <!-- Cabeçalho fixo com cor azul -->
    <div class="bg-primary text-white text-center py-4">
        <h1 class="mb-0">Sistema de Empréstimos de Equipamentos</h1>
    </div>

    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Botão Inicial Simples -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}">
                            Inicial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('equipamentos.create') }}">
                            <i class="fas fa-cogs me-2"></i> Cadastrar Equipamento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usuarios.create') }}">
                            <i class="fas fa-users me-2"></i> Cadastrar Usuário
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('emprestimos.create') }}">
                            <i class="fas fa-hand-holding-usd me-2"></i> Cadastrar Empréstimo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('equipamentos.index') }}">
                            <i class="fas fa-cogs me-2"></i> Lista de Equipamentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usuarios.index') }}">
                            <i class="fas fa-users me-2"></i> Lista de Usuários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('emprestimos.index') }}">
                            <i class="fas fa-hand-holding-usd me-2"></i> Lista de Empréstimos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('relatorio.index') }}">
                            <i class="fas fa-chart-line me-2"></i> Ver Relatório
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Botão de Sair -->
    <div class="btnSair">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Sair</button>
        </form>
    </div>

    <div class="container py-5 content-wrapper">
        <!-- Seção de conteúdo será injetada aqui -->
        @yield('content')
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Aqui você pode adicionar o script para os gráficos -->
    @yield('scripts')
</body>
</html>
