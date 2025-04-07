<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema de Empréstimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Para ícones -->
    <style>
        /* Estilo personalizado para os cards e botões */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 2rem;
        }

        .btn-primary, .btn-secondary {
            border-radius: 25px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .icon-card {
            font-size: 50px;
            color: #007bff;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Cabeçalho fixo -->
    <div class="bg-primary text-white text-center py-4">
        <h1 class="mb-0">Sistema de Empréstimos de Equipamentos</h1>
    </div>

    <div class="container py-5">
        <!-- Cartões de Visão Geral -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
            <!-- Cartão de Equipamentos Totais -->
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-cogs icon-card"></i>
                        <h5 class="card-title text-muted">Equipamentos Totais</h5>
                        <p class="card-text fs-1 fw-bold text-dark">{{ $totalEquipamentos }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Usuários Cadastrados -->
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-users icon-card"></i>
                        <h5 class="card-title text-muted">Usuários Cadastrados</h5>
                        <p class="card-text fs-1 fw-bold text-dark">{{ $totalUsuarios }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Empréstimos Totais -->
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-hand-holding-usd icon-card"></i>
                        <h5 class="card-title text-muted">Empréstimos Totais</h5>
                        <p class="card-text fs-1 fw-bold text-dark">{{ $totalEmprestimos }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Empréstimos Ativos -->
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-sync-alt icon-card"></i>
                        <h5 class="card-title text-muted">Empréstimos Ativos</h5>
                        <p class="card-text fs-1 fw-bold text-dark">{{ $totalEmprestimosAtivos }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cartões de Ações -->
        <div class="row mt-4">
            <div class="col-md-3 mb-3">
                <a href="{{ route('equipamentos.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-cogs me-2"></i> Cadastrar Equipamento
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-users me-2"></i> Cadastrar Usuário
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('emprestimos.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-hand-holding-usd me-2"></i> Cadastrar Empréstimo
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('relatorio.index') }}" class="btn btn-primary w-100">
                    <i class="fas fa-chart-line me-2"></i> Ver Relatorio
                </a>
            </div>
        </div>

        <!-- Links para as páginas de listagem -->
        <div class="row mt-4">
            <div class="col-md-3 mb-3">
                <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-cogs me-2"></i> Lista de Equipamentos
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-users me-2"></i> Lista de Usuários
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-hand-holding-usd me-2"></i> Lista de Empréstimos
                </a>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
