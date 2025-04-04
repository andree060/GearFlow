<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Detalhes do Usuário</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <tr>
                <th>Nome</th>
                <td>{{ $usuario->nome }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $usuario->email }}</td>
            </tr>
        </table>

        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>
