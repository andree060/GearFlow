<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empréstimos</title>
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
        <h1 class="mb-0">Lista de Empréstimos</h1>
    </div>

    <div class="container mt-5">
        <!-- Mensagem de Alerta -->
        <div class="alert alert-success alert-custom" id="successAlert">
            <i class="fas fa-check-circle me-2"></i> Empréstimo excluído com sucesso!
        </div>

        <!-- Tabela de Empréstimos -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Equipamento</th>
                        <th>Usuário</th>
                        <th>Data Empréstimo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprestimos as $emprestimo)
                        <tr>
                            <td>{{ $emprestimo->id }}</td>
                            <td>{{ $emprestimo->equipamento->nome }}</td>
                            <td>{{ $emprestimo->user->name }}</td> <!-- Acesso ao nome do usuário -->
                            <td>{{ $emprestimo->data_emprestimo }}</td>
                            <td>
                                <!-- Exibe o status "ativo" ou "expirado" -->
                                <span class="badge {{ $emprestimo->status == 'ativo' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($emprestimo->status) }}
                                </span>
                            </td>
                            <td>
                                <!-- Botões Visualizar, Editar e Excluir -->
                                <div class="d-flex flex-column gap-2">
                                    <!-- Botão Visualizar -->
                                    <a href="{{ route('emprestimos.show', $emprestimo->id) }}" class="btn btn-info w-100">Visualizar</a>
                                    <!-- Botão Editar -->
                                    <a href="{{ route('emprestimos.edit', $emprestimo->id) }}" class="btn btn-warning w-100">Editar</a>
                                    <!-- Formulário Excluir -->
                                    <form action="{{ route('emprestimos.destroy', $emprestimo->id) }}" method="POST" class="delete-form">
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

        <div class="d-flex justify-content-end">
            <a href="{{ route('home.index') }}" class="btn btn-secondary w-auto">Voltar</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Exibe o alerta de sucesso
        function showSuccessAlert() {
            const successAlert = document.getElementById('successAlert');
            successAlert.style.display = 'block';

            // Esconde o alerta após 5 segundos
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 5000);
        }

        // Confirma a exclusão antes de enviar o formulário
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Impede o envio imediato

                // Confirmação antes de excluir
                if (confirm('Tem certeza que deseja excluir este empréstimo?')) {
                    // Envia o formulário após confirmação
                    this.submit();
                    showSuccessAlert();
                }
            });
        });
    </script>

</body>
</html>
