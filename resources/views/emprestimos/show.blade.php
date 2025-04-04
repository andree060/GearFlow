<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Empréstimo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Detalhes do Empréstimo</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
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

        <a href="{{ route('emprestimos.edit', $emprestimo->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>
