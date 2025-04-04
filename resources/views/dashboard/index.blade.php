<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Empréstimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Dashboard</h1>
        <div class="row mt-4">
            <!-- Cartão de Equipamentos -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Equipamentos Totais</h5>
                        <p class="card-text">{{ $totalEquipamentos }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Equipamentos Disponíveis -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Equipamentos Disponíveis</h5>
                        <p class="card-text">{{ $totalEquipamentosDisponiveis }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Usuários -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Usuários Cadastrados</h5>
                        <p class="card-text">{{ $totalUsuarios }}</p>
                    </div>
                </div>
            </div>

            <!-- Cartão de Empréstimos Ativos -->
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
            <!-- Cartão de Empréstimos Devolvidos -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Empréstimos Devolvidos</h5>
                        <p class="card-text">{{ $totalEmprestimosDevolvidos }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
