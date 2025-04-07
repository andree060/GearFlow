<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Equipamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Título da página com cor personalizada -->
    <div class="bg-primary text-white text-center py-4">
        <h1 class="mb-0">Detalhes do Equipamento</h1>
    </div>
    
    <div class="container mt-5">
        
        <!-- Exibição de mensagens de sucesso, se houver -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card para os detalhes do equipamento -->
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Tabela de detalhes -->
                <table class="table table-striped">
                    <tr>
                        <th>Nome</th>
                        <td>{{ $equipamento->nome }}</td>
                    </tr>
                    <tr>
                        <th>Número de Série</th>
                        <td>{{ $equipamento->numero_serie }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $equipamento->status }}</td>
                    </tr>
                </table>

                <!-- Botões de ação -->
                <div class="d-flex justify-content-start gap-2">
                    <a href="{{ route('equipamentos.edit', $equipamento->id) }}" class="btn btn-warning w-auto">Editar</a>
                    <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary w-auto">Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
