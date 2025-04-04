<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Equipamento</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário de Edição -->
        <form action="{{ route('equipamentos.update', $equipamento->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Informa que é um método PUT para o update -->

            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Equipamento</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $equipamento->nome) }}" required>
            </div>

            <div class="mb-3">
                <label for="numero_serie" class="form-label">Número de Série</label>
                <input type="text" name="numero_serie" id="numero_serie" class="form-control" value="{{ old('numero_serie', $equipamento->numero_serie) }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="disponível" {{ $equipamento->status == 'disponível' ? 'selected' : '' }}>Disponível</option>
                    <option value="emprestado" {{ $equipamento->status == 'emprestado' ? 'selected' : '' }}>Emprestado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>

        <a href="{{ route('equipamentos.show', $equipamento->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
</body>
</html>
