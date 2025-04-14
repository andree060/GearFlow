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
                        <label for="nome" class="form-label">Nome do Equipamento</label>
                        <input type="text" name="nome" id="nome" class="form-control" required placeholder="Informe o nome do equipamento">
                    </div>

                    <!-- Campo Número de Série -->
                    <div class="mb-3">
                        <label for="numero_serie" class="form-label">Número de Série</label>
                        <input type="text" name="numero_serie" id="numero_serie" class="form-control" required placeholder="Informe o número de série">
                    </div>

                    <!-- Campo Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="disponível">Disponível</option>
                            <option value="indisponível">Indisponível</option>
                        </select>
                    </div>

                    <!-- Campo Categoria -->
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoria</label>
                        <select name="categoria_id" id="categoria_id" class="form-control">
                            <option value="">Escolha uma categoria existente</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>

                        <!-- Campo para criar nova categoria -->
                        <div class="mt-3">
                            <label for="categoria_nome" class="form-label">Ou crie uma nova categoria</label>
                            <input type="text" name="categoria_nome" id="categoria_nome" class="form-control" placeholder="Digite o nome da nova categoria">
                        </div>
                    </div>

                    <!-- Campo Setor -->
                    <div class="mb-3">
                        <label for="setor_id" class="form-label">Setor</label>
                        <select name="setor_id" id="setor_id" class="form-control">
                            <option value="">Escolha um setor existente</option>
                            @foreach($setores as $setor)
                                <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                            @endforeach
                        </select>

                        <!-- Campo para criar novo setor -->
                        <div class="mt-3">
                            <label for="setor_nome" class="form-label">Ou crie um novo setor</label>
                            <input type="text" name="setor_nome" id="setor_nome" class="form-control" placeholder="Digite o nome do novo setor">
                        </div>
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
@endsection
