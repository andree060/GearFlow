<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert-custom {
            display: none;
            font-size: 16px;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Título com cor azul -->
                <h1 class="text-center mb-4 text-primary">Editar Usuário</h1>

                <!-- Exibição de mensagens de sucesso -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulário de edição de usuário -->
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT') <!-- Método PUT para o update -->

                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small>Deixe em branco para manter a senha atual</small>
                    </div>

                    <!-- Confirmação de Senha -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-secondary" onclick="return confirmCancel()">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para confirmar o cancelamento do formulário
        function confirmCancel() {
            return confirm('Tem certeza que deseja cancelar? As alterações não serão salvas.');
        }

        // Validação de senhas e campos obrigatórios antes de enviar o formulário
        document.getElementById('editUserForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var passwordConfirmation = document.getElementById('password_confirmation').value;

            // Verificar se as senhas coincidem (somente se a senha foi preenchida)
            if (password !== '' && password !== passwordConfirmation) {
                alert('As senhas não coincidem.');
                event.preventDefault(); // Impede o envio do formulário
            }

            // Verificar se os campos obrigatórios estão preenchidos
            if (password !== '' && passwordConfirmation === '') {
                alert('Por favor, confirme a senha.');
                event.preventDefault(); // Impede o envio do formulário
            }
        });
    </script>
</body>
</html>
