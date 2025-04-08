<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4 text-primary">Editar Equipamento</h1>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('equipamentos.update', $equipamento->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                        <select name="status" id="status" class="form-select" required>
                            <option value="disponível" {{ $equipamento->status == 'disponível' ? 'selected' : '' }}>Disponível</option>
                            <option value="emprestado" {{ $equipamento->status == 'emprestado' ? 'selected' : '' }}>Emprestado</option>
                            <option value="indisponível" {{ $equipamento->status == 'indisponível' ? 'selected' : '' }}>Indisponível</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
