<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Usuário</h1>

        <!-- Exibição da mensagem de sucesso, caso haja -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Isso informa ao Laravel que é um método PUT (atualização) -->

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $usuario->nome) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control">
                <small>Deixe em branco para manter a senha atual</small>
            </div>

            <div class="mb-3">
                <label for="senha_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" name="senha_confirmation" id="senha_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>

        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
</body>
</html>
