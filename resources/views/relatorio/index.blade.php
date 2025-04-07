<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Empréstimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Estilo para os cartões */
        .dashboard-card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            transition: transform 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .dashboard-card .card-body {
            padding: 30px;
        }
        .dashboard-card .card-title {
            font-size: 1.3rem;
        }
        .dashboard-card .card-text {
            font-size: 2.5rem;
            font-weight: bold;
        }
        /* Estilos para os gráficos */
        .chart-container {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px;
        }
        /* Ajuste no espaçamento entre os gráficos */
        .row .col-md-4 {
            margin-bottom: 30px;
        }
        /* Ajuste no layout dos botões de ação */
        .action-buttons .col-md-3 {
            margin-bottom: 20px;
        }
        /* Layout para telas menores */
        @media (max-width: 768px) {
            .dashboard-card .card-text {
                font-size: 2rem;
            }
            .row-cols-md-2 .col {
                margin-bottom: 20px;
            }
        }
        .topo{
            display: flex;
            justify-content: space-around;
        }

    </style>
</head>
<body class="bg-light">

    <!-- Cabeçalho fixo -->
    <div class="bg-primary text-white  py-4 topo">
        <div class="topo-titulo">
            <h1 class="mb-0">Relatorios</h1>
        </div>
        <!-- Verifica se o usuário está autenticado -->
        @auth
        <div class="bntSair">
        <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Sair</button>
            </form>
        </div>

        @endauth

    </div>

    <div class="container py-5">
        <!-- Cartões de Visão Geral -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
            <!-- Cartão de Equipamentos Totais -->
            <div class="col">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Equipamentos Totais</h5>
                        <p class="card-text text-dark">{{ $totalEquipamentos }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Equipamentos Disponíveis -->
            <div class="col">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Equipamentos Disponíveis</h5>
                        <p class="card-text text-dark">{{ $totalEquipamentosDisponiveis }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Equipamentos em Empréstimo -->
            <div class="col">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Equipamentos em Empréstimo</h5>
                        <p class="card-text text-dark">{{ $totalEquipamentosEmEmprestimo }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Equipamentos Indisponíveis -->
            <div class="col">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Equipamentos Indisponíveis</h5>
                        <p class="card-text text-dark">{{ $totalEquipamentosIndisponiveis }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Empréstimos Ativos -->
            <div class="col">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Empréstimos Ativos</h5>
                        <p class="card-text text-dark">{{ $totalEmprestimosAtivos }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Empréstimos Expirados -->
            <div class="col">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Empréstimos Expirados</h5>
                        <p class="card-text text-dark">{{ $totalEmprestimosExpirados }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Usuários Cadastrados -->
            <div class="col">
                <div class="card dashboard-card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Usuários Cadastrados</h5>
                        <p class="card-text text-dark">{{ $totalUsuarios }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção de Gráficos -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="chart-container">
                    <h5 class="text-center">Empréstimos</h5>
                    <canvas id="emprestimosChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container">
                    <h5 class="text-center">Equipamentos</h5>
                    <canvas id="equipamentosChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container">
                    <h5 class="text-center">Usuários</h5>
                    <canvas id="usuariosChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Ações do Dashboard -->
        <div class="row action-buttons">
            <div class="col-md-3 mb-3">
                <a href="{{ route('equipamentos.create') }}" class="btn btn-primary w-100">Cadastrar Equipamento</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary w-100">Cadastrar Usuário</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('emprestimos.create') }}" class="btn btn-primary w-100">Cadastrar Empréstimo</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('home.index') }}" class="btn btn-primary w-100">Home</a>
            </div>
        </div>
    </div>

    <script>
        // Dados do gráfico de empréstimos
        const emprestimosData = {
            labels: ['Ativos', 'Expirados'],
            datasets: [{
                label: 'Empréstimos',
                data: [{{ $totalEmprestimosAtivos }}, {{ $totalEmprestimosExpirados }}],
                backgroundColor: ['#007bff', '#dc3545'],
                borderColor: ['#0056b3', '#c82333'],
                borderWidth: 1
            }]
        };

        // Dados do gráfico de equipamentos
        const equipamentosData = {
            labels: ['Disponíveis', 'Em Empréstimo', 'Indisponíveis'],
            datasets: [{
                label: 'Equipamentos',
                data: [{{ $totalEquipamentosDisponiveis }}, {{ $totalEquipamentosEmEmprestimo }}, {{ $totalEquipamentosIndisponiveis }}],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                borderColor: ['#218838', '#e0a800', '#c82333'],
                borderWidth: 1
            }]
        };

        // Dados do gráfico de usuários
        const usuariosData = {
            labels: ['Cadastrados'],
            datasets: [{
                label: 'Usuários',
                data: [{{ $totalUsuarios }}],
                backgroundColor: ['#007bff'],
                borderColor: ['#0056b3'],
                borderWidth: 1
            }]
        };

        // Opções comuns para os gráficos
        const options = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true
                }
            }
        };

        // Criando os gráficos
        new Chart(document.getElementById('emprestimosChart'), {
            type: 'bar',
            data: emprestimosData,
            options: options
        });

        new Chart(document.getElementById('equipamentosChart'), {
            type: 'bar',
            data: equipamentosData,
            options: options
        });

        new Chart(document.getElementById('usuariosChart'), {
            type: 'bar',
            data: usuariosData,
            options: options
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
