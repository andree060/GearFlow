<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipamento</title>
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
                <h1 class="text-center mb-4 text-primary">Editar Equipamento</h1>
                
                <!-- Exibição de mensagens de sucesso -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulário de Edição do Equipamento -->
                <form action="{{ route('equipamentos.update', $equipamento->id) }}" method="POST" id="equipamentoForm">
                    @csrf
                    @method('PUT') <!-- Informa que é um método PUT para o update -->

                    <!-- Nome do Equipamento -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Equipamento</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $equipamento->nome) }}" required>
                    </div>

                    <!-- Número de Série -->
                    <div class="mb-3">
                        <label for="numero_serie" class="form-label">Número de Série</label>
                        <input type="text" name="numero_serie" id="numero_serie" class="form-control" value="{{ old('numero_serie', $equipamento->numero_serie) }}" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="disponível" {{ $equipamento->status == 'disponível' ? 'selected' : '' }}>Disponível</option>
                            <option value="emprestado" {{ $equipamento->status == 'emprestado' ? 'selected' : '' }}>Emprestado</option>
                            <option value="indisponível" {{ $equipamento->status == 'indisponível' ? 'selected' : '' }}>Indisponível</option>
                        </select>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary w-48" id="submitBtn">Atualizar</button>
                        <a href="{{ route('equipamentos.show', $equipamento->id) }}" class="btn btn-secondary w-48" onclick="return confirmCancel()">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para confirmar o cancelamento da edição
        function confirmCancel() {
            return confirm('Tem certeza que deseja cancelar a edição? As alterações não serão salvas.');
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
