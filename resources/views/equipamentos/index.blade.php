<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert-custom {
            display: none;
            font-size: 16px;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Título da página com cor personalizada -->
    <div class="bg-primary text-white text-center py-4">
        <h1 class="mb-0">Lista de Equipamentos</h1>
    </div>

    <div class="container mt-5">

        <!-- Tabela de Equipamentos -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
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
                                <!-- Botões Visualizar, Editar e Excluir -->
                                <div class="d-flex flex-column gap-2">
                                    <!-- Botão Visualizar -->
                                    <a href="{{ route('equipamentos.show', $equipamento->id) }}" class="btn btn-info w-100">Visualizar</a>
                                    <!-- Botão Editar -->
                                    <a href="{{ route('equipamentos.edit', $equipamento->id) }}" class="btn btn-warning w-100" onclick="return confirmEdit()">Editar</a>
                                    <!-- Formulário Excluir -->
                                    <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botão Voltar -->
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('home.index') }}" class="btn btn-secondary">Voltar</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para confirmar a exclusão de um equipamento
        function confirmDelete() {
            return confirm('Tem certeza que deseja excluir este equipamento?');
        }

        // Função para confirmar se o usuário deseja editar o equipamento
        function confirmEdit() {
            return confirm('Tem certeza que deseja editar este equipamento?');
        }
    </script>
</body>
</html>
