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
        <div class="card-body col-12 col-md-10 col-lg-8 mx-auto">
            <h1 class="text-center mb-4 text-primary">Cadastrar Equipamento</h1>
            <!-- Mensagens de Erro -->
            @if ($errors->any())
            <div class="alert alert-danger shadow-sm rounded">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('equipamentos.store') }}" method="POST">
                @csrf

                <!-- Nome do Equipamento -->
                <div class="mb-4">
                    <div class="text-start">
                        <label for="nome" class="form-label fw-bold ps-1">Nome do Equipamento</label>
                    </div>
                    <input type="text" name="nome" id="nome" class="form-control" required
                        placeholder="Informe o nome do equipamento">
                </div>

                <!-- Número de Série e Status -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="numero_serie" class="form-label fw-bold">Número de Série</label>
                        </div>
                        <input type="text" name="numero_serie" id="numero_serie" class="form-control" required
                            placeholder="Informe o número de série">
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="text-start">

                            <label for="status" class="form-label fw-bold">Status</label>
                        </div>
                        <select name="status" id="status" class="form-select" required>
                            <option value="disponível">Disponível</option>
                            <option value="indisponível">Indisponível</option>
                        </select>
                    </div>
                </div>

                <!-- Linha divisória -->
                <hr class="my-4">

                <!-- Categoria e Nova Categoria -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <div class="text-start">

                            <label for="categoria_id" class="form-label fw-bold">Categoria Existente</label>
                        </div>
                        <select name="categoria_id" id="categoria_id" class="form-select">
                            <option value="">Escolha uma categoria existente</option>
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="text-start">

                            <label for="categoria_nome" class="form-label fw-bold">Nova Categoria</label>
                        </div>
                        <input type="text" name="categoria_nome" id="categoria_nome" class="form-control"
                            placeholder="Digite o nome da nova categoria">
                    </div>
                </div>

                <!-- Linha divisória -->
                <hr class="my-4">

                <!-- Setor e Novo Setor -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <div class="text-start">

                            <label for="setor_id" class="form-label fw-bold">Setor Existente</label>
                        </div>
                        <select name="setor_id" id="setor_id" class="form-select">
                            <option value="">Escolha um setor existente</option>
                            @foreach($setores as $setor)
                            <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="text-start">

                            <label for="setor_nome" class="form-label fw-bold">Novo Setor</label>
                        </div>
                        <input type="text" name="setor_nome" id="setor_nome" class="form-control"
                            placeholder="Digite o nome do novo setor">
                    </div>
                </div>

                <!-- Botões  -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">Salvar</button>
                    <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill"
                        onclick="return confirm('Tem certeza que deseja cancelar?')">
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>



</div>
@endsection