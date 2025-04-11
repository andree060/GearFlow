@extends('layouts.app')

@section('title', 'Cadastrar Empréstimo')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="text-center mb-4 text-primary">Cadastrar Empréstimo</h1>

            <!-- Erros de validação -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Erro de lógica -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulário -->
            <form id="emprestimoForm" action="{{ route('emprestimos.store') }}" method="POST">
                @csrf

                <!-- Equipamento -->
                <div class="mb-3">
                    <label for="equipamento_id" class="form-label">Equipamento</label>
                    <select name="equipamento_id" id="equipamento_id" class="form-select" required onchange="showEquipamentoDetails()">
                        @foreach($equipamentos as $equipamento)
                            <option 
                                value="{{ $equipamento->id }}"
                                data-categoria="{{ optional($equipamento->categoria)->nome }}"
                                data-setor="{{ optional($equipamento->setor)->nome }}"
                                data-status="{{ $equipamento->statusAtual() }}"
                                style="background-color: 
                                    {{ $equipamento->statusAtual() === 'funcionando' ? 'green' : 
                                       ($equipamento->statusAtual() === 'manutenção' ? 'red' : '') }}"
                                @if($equipamento->isEmManutencao()) disabled @endif
                            >
                                {{ $equipamento->nome }}
                                @if($equipamento->manutencoes->count() > 0)
                                    - {{ $equipamento->statusAtual() }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Categoria -->
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text" id="categoria" class="form-control" readonly>
                </div>

                <!-- Setor -->
                <div class="mb-3">
                    <label for="setor" class="form-label">Setor</label>
                    <input type="text" name="setor_nome" id="setor" class="form-control" readonly>
                </div>

                <!-- Usuário -->
                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuário</label>
                    <select name="user_id" id="user_id" class="form-select" required>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Datas -->
                <div class="mb-3">
                    <label for="data_emprestimo" class="form-label">Data do Empréstimo</label>
                    <input type="date" name="data_emprestimo" id="data_emprestimo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="data_devolucao_prevista" class="form-label">Data de Devolução Prevista</label>
                    <input type="date" name="data_devolucao_prevista" id="data_devolucao_prevista" class="form-control" required>
                </div>

                <!-- Ações -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary w-48">Salvar</button>
                    <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary w-48">Voltar</a>
                </div>
            </form>

            <!-- Sucesso -->
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    <i class="fas fa-check-circle me-2"></i> Empréstimo cadastrado com sucesso!
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showEquipamentoDetails() {
        const equipamento = document.getElementById('equipamento_id').selectedOptions[0];

        const categoria = equipamento.getAttribute('data-categoria');
        const setor = equipamento.getAttribute('data-setor');
        const status = equipamento.getAttribute('data-status');

        document.getElementById('categoria').value = categoria || '';
        document.getElementById('setor').value = setor || '';
    }

    window.onload = function () {
        showEquipamentoDetails();
    };
</script>
@endsection
