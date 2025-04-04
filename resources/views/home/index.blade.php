<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema de Empréstimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Bem-vindo ao Sistema de Empréstimos de Equipamentos</h1>

        <div class="row mt-4">
            <!-- Visão Geral -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Equipamentos Totais</h5>
                        <p class="card-text">{{ $totalEquipamentos }}</p>
                    </div>
                </div>
            </div>

            <!-- Total de Usuários -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Usuários Cadastrados</h5>
                        <p class="card-text">{{ $totalUsuarios }}</p>
                    </div>
                </div>
            </div>

            <!-- Total de Empréstimos -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Empréstimos Totais</h5>
                        <p class="card-text">{{ $totalEmprestimos }}</p>
                    </div>
                </div>
            </div>

            <!-- Empréstimos Ativos -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Empréstimos Ativos</h5>
                        <p class="card-text">{{ $totalEmprestimosAtivos }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Links Rápidos -->
            <div class="col-md-3">
                <a href="{{ route('equipamentos.create') }}" class="btn btn-primary w-100">Cadastrar Equipamento</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary w-100">Cadastrar Usuário</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('emprestimos.create') }}" class="btn btn-primary w-100">Cadastrar Empréstimo</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary w-100">Ver Dashboard</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
