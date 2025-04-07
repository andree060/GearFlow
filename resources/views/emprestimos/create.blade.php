<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Empréstimo</title>
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
                <h1 class="text-center mb-4 text-primary">Cadastrar Empréstimo</h1>

                <!-- Exibição de mensagens de erro do Laravel -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulário -->
                <form id="emprestimoForm" action="{{ route('emprestimos.store') }}" method="POST">
                    @csrf

                    <!-- Equipamento -->
                    <div class="mb-3">
                        <label for="equipamento_id" class="form-label">Equipamento</label>
                        <select name="equipamento_id" id="equipamento_id" class="form-select" required>
                            @foreach($equipamentos as $equipamento)
                                <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Usuário -->
                    <div class="mb-3">
                        <label for="usuario_id" class="form-label">Usuário</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data do Empréstimo -->
                    <div class="mb-3">
                        <label for="data_emprestimo" class="form-label">Data do Empréstimo</label>
                        <input type="date" name="data_emprestimo" id="data_emprestimo" class="form-control" required>
                    </div>

                    <!-- Data de Devolução Prevista -->
                    <div class="mb-3">
                        <label for="data_devolucao_prevista" class="form-label">Data de Devolução Prevista</label>
                        <input type="date" name="data_devolucao_prevista" id="data_devolucao_prevista" class="form-control" required>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary w-48">Salvar</button>
                        <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary w-48">Voltar</a>
                    </div>
                </form>

                <!-- Mensagem de Alerta de Sucesso -->
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-2"></i> Empréstimo cadastrado com sucesso!
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para validar o formulário antes de enviar
        document.getElementById('emprestimoForm').addEventListener('submit', function(event) {
            // Impede o envio se algum campo obrigatório estiver vazio
            const equipamento = document.getElementById('equipamento_id');
            const usuario = document.getElementById('usuario_id');
            const dataEmprestimo = document.getElementById('data_emprestimo');
            const dataDevolucao = document.getElementById('data_devolucao_prevista');

            if (!equipamento.value || !usuario.value || !dataEmprestimo.value || !dataDevolucao.value) {
                event.preventDefault();
                alert("Por favor, preencha todos os campos obrigatórios.");
            }
        });
    </script>

</body>
</html>
