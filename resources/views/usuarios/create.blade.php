<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Cadastrar Usuário</h1>

        <!-- Formulário de cadastro de usuário -->
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf  <!-- Token CSRF para segurança -->

            <!-- Nome -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <!-- Senha -->
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>
            </div>

            <!-- Confirmação de Senha -->
            <div class="mb-3">
                <label for="senha_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" name="senha_confirmation" id="senha_confirmation" class="form-control" required>
            </div>

            <!-- Botão de Enviar -->
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

        <!-- Exibição de mensagens de sucesso ou erro -->
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

    </div>
</body>
</html>
