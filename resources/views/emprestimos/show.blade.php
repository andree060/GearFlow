<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Empréstimo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Título da página com cor personalizada -->
    <div class="bg-primary text-white text-center py-4">
        <h1 class="mb-0">Detalhes do Empréstimo</h1>
    </div>
    <div class="container mt-5">
        
        

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabela com detalhes do empréstimo -->
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Tabela de detalhes -->
                <table class="table table-striped">
                <tr>
                    <th>Equipamento</th>
                    <td>{{ $emprestimo->equipamento->nome }}</td>
                </tr>
                <tr>
                    <th>Usuário</th>
                    <td>{{ $emprestimo->usuario->nome }}</td>
                </tr>
                <tr>
                    <th>Data do Empréstimo</th>
                    <td>{{ $emprestimo->data_emprestimo }}</td>
                </tr>
                <tr>
                    <th>Data de Devolução Prevista</th>
                    <td>{{ $emprestimo->data_devolucao_prevista }}</td>
                </tr>
            </table>
            
            <div class="d-flex justify-content-start gap-2">
                <a href="{{ route('emprestimos.edit', $emprestimo->id) }}" class="btn btn-warning w-auto">Editar</a>
                <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary w-auto">Voltar</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
