@extends('layouts.app')

@section('title', 'Cadastrar Equipamento')

@section('content')
    <div class="container mt-5">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4 text-primary">Cadastrar Equipamento</h1>
                <form action="{{ route('equipamentos.store') }}" method="POST">
                    @csrf

                    <!-- Campo Nome -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>

                    <!-- Campo Número de Série -->
                    <div class="mb-3">
                        <label for="numero_serie" class="form-label">Número de Série</label>
                        <input type="text" name="numero_serie" id="numero_serie" class="form-control" required>
                    </div>

                    <!-- Campo Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="disponível">Disponível</option>
                            <option value="emprestado">Emprestado</option>
                            <option value="indisponível">Indisponível</option>
                        </select>
                    </div>

                    <!-- Campo Categoria (Nome da categoria) -->
                    <div class="mb-3">
                        <label for="categoria_nome" class="form-label">Categoria</label>
                        <input type="text" name="categoria_nome" id="categoria_nome" class="form-control" required>
                    </div>

                    <!-- Campo Setor (Nome do setor) -->
                    <div class="mb-3">
                        <label for="setor_nome" class="form-label">Setor</label>
                        <input type="text" name="setor_nome" id="setor_nome" class="form-control" required>
                    </div>

                    <!-- Campo Usuário Responsável (apenas se o status for "emprestado") -->
                    <div class="mb-3" id="usuario_responsavel_div" style="display: none;">
                        <label for="usuario_responsavel" class="form-label">Usuário Responsável</label>
                        <select name="usuario_responsavel" id="usuario_responsavel" class="form-control">
                            <option value="">Selecione um usuário</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botões -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary" onclick="return confirm('Tem certeza que deseja cancelar?')">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Exibe o campo de usuário responsável apenas se o status for "emprestado"
        document.getElementById('status').addEventListener('change', function () {
            const usuarioResponsavelDiv = document.getElementById('usuario_responsavel_div');
            const status = this.value;

            if (status === 'emprestado') {
                usuarioResponsavelDiv.style.display = 'block';
            } else {
                usuarioResponsavelDiv.style.display = 'none';
            }
        });
    </script>
@endsection
