<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Empréstimo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Cadastrar Empréstimo</h1>

        <form action="{{ route('emprestimos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="equipamento_id" class="form-label">Equipamento</label>
                <select name="equipamento_id" id="equipamento_id" class="form-control" required>
                    @foreach($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="usuario_id" class="form-label">Usuário</label>
                <select name="usuario_id" id="usuario_id" class="form-control" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="data_emprestimo" class="form-label">Data do Empréstimo</label>
                <input type="date" name="data_emprestimo" id="data_emprestimo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="data_devolucao_prevista" class="form-label">Data de Devolução Prevista</label>
                <input type="date" name="data_devolucao_prevista" id="data_devolucao_prevista" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</body>
</html>
