<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Equipamento</title>
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
        <!-- Exibição de mensagens de erro, se houver -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de Cadastro -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4 text-primary">Cadastrar Equipamento</h1>
                <form action="{{ route('equipamentos.store') }}" method="POST" id="equipamentoForm">
                    @csrf

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="numero_serie" class="form-label">Número de Série</label>
                        <input type="text" name="numero_serie" id="numero_serie" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Disponível">Disponível</option>
                            <option value="Em Empréstimo">Em Empréstimo</option>
                            <option value="Indisponível">Indisponível</option>
                        </select>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary w-48" id="submitBtn">Salvar</button>
                        <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary w-48" onclick="return confirmCancel()">Voltar</a>
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

        // Validação para verificar se os campos obrigatórios estão preenchidos
        document.getElementById('equipamentoForm').addEventListener('submit', function(event) {
            var nome = document.getElementById('nome').value;
            var numero_serie = document.getElementById('numero_serie').value;
            var status = document.getElementById('status').value;

            // Verificar se os campos estão vazios
            if (!nome || !numero_serie || !status) {
                alert('Por favor, preencha todos os campos obrigatórios.');
                event.preventDefault(); // Impede o envio do formulário
            }
        });
    </script>
</body>
</html>
