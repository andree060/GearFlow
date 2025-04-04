<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empréstimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Empréstimos</h1>
        <a href="{{ route('emprestimos.create') }}" class="btn btn-primary mb-3">Novo Empréstimo</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Equipamento</th>
                    <th>Usuário</th>
                    <th>Data Empréstimo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emprestimos as $emprestimo)
                    <tr>
                        <td>{{ $emprestimo->id }}</td>
                        <td>{{ $emprestimo->equipamento->nome }}</td>
                        <td>{{ $emprestimo->usuario->nome }}</td>
                        <td>{{ $emprestimo->data_emprestimo }}</td>
                        <td>{{ $emprestimo->status }}</td>
                        <td>
                            <a href="{{ route('emprestimos.edit', $emprestimo->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('emprestimos.destroy', $emprestimo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
