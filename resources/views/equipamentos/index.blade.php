<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Equipamentos</h1>
        <a href="{{ route('equipamentos.create') }}" class="btn btn-primary mb-3">Cadastrar Novo Equipamento</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Número de Série</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipamentos as $equipamento)
                    <tr>
                        <td>{{ $equipamento->id }}</td>
                        <td>{{ $equipamento->nome }}</td>
                        <td>{{ $equipamento->numero_serie }}</td>
                        <td>{{ $equipamento->status }}</td>
                        <td>
                            <a href="{{ route('equipamentos.edit', $equipamento->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST" style="display:inline;">
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
