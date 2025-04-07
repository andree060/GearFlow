<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Título da página com cor personalizada -->
    <div class="bg-primary text-white text-center py-4">
        <h1 class="mb-0">Lista de Usuários</h1>
    </div>

    <div class="container mt-5">

        <!-- Tabela de Usuários -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nome }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                <!-- Botões de Visualizar, Editar e Excluir -->
                                <div class="d-flex flex-column gap-2">
                                    <!-- Botão Visualizar -->
                                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info w-100">Visualizar</a>
                                    <!-- Botão Editar -->
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning w-100" onclick="return confirmEdit()">Editar</a>
                                    <!-- Formulário Excluir -->
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100" onclick="return confirmDelete()">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botão de Voltar alinhado à direita -->
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('home.index') }}" class="btn btn-secondary">Voltar</a>
        </div>

    </div>

    <!-- Adicionando o script JavaScript para confirmação -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para confirmar a exclusão de um Usuário
        function confirmDelete() {
            return confirm('Tem certeza que deseja excluir este usuário?');
        }

        // Função para confirmar se o usuário deseja editar o Usuário
        function confirmEdit() {
            return confirm('Tem certeza que deseja editar este usuário?');
        }
    </script>
</body>
</html>
