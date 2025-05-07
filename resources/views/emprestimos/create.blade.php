@extends('layouts.app')

@section('title', 'Cadastrar Empréstimo')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body col-12 col-md-10 col-lg-10 mx-auto">
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

                <!-- Equipamento e Usuário -->
                <div class="row">
                    <!-- Equipamento -->
                    <div class="col-md-8 mb-3">
                        <div class="text-start">
                            <label for="equipamento_id" class="form-label fw-bold text-dark">Equipamento</label>
                        </div>
                        <select name="equipamento_id" id="equipamento_id" class="form-select" required
                            onchange="showEquipamentoDetails()">
                            @foreach($equipamentos as $equipamento)
                            <option value="{{ $equipamento->id }}"
                                data-categoria="{{ optional($equipamento->categoria)->nome }}"
                                data-setor="{{ optional($equipamento->setor)->nome }}">
                                {{ $equipamento->nome }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Usuário (menos espaço) -->
                    <div class="col-md-4 mb-3">
                        <div class="text-start">
                            <label for="user_id" class="form-label fw-bold text-dark">Usuário</label>

                        </div>
                        <select name="user_id" id="user_id" class="form-select" required>
                            @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Categoria e Setor -->
                <div class="row">
                    <!-- Categoria -->
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="categoria" class="form-label fw-bold text-dark">Categoria</label>

                        </div>
                        <input type="text" id="categoria" class="form-control" readonly>
                    </div>

                    <!-- Setor -->
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="setor" class="form-label fw-bold text-dark">Setor</label>

                        </div>
                        <input type="text" name="setor_nome" id="setor" class="form-control" readonly>
                    </div>
                </div>

                <!-- Data do Empréstimo e Data de Devolução -->
                <div class="row">
                    <!-- Data do Empréstimo -->
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="data_emprestimo" class="form-label fw-bold text-dark">Data do Empréstimo</label>

                        </div>
                        <input type="date" name="data_emprestimo" id="data_emprestimo" class="form-control" required>
                    </div>

                    <!-- Data de Devolução -->
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="data_devolucao_prevista" class="form-label fw-bold text-dark">Data de Devolução
                                Prevista</label>
                        </div>

                        <input type="date" name="data_devolucao_prevista" id="data_devolucao_prevista"
                            class="form-control" required>
                    </div>
                </div>

                <!-- Ações  -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">Salvar</button>
                    <a href="{{ route('emprestimos.index') }}"
                        class="btn btn-secondary px-4 py-2 rounded-pill">Voltar</a>
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

    document.getElementById('categoria').value = categoria || '';
    document.getElementById('setor').value = setor || '';
}

window.onload = function() {
    showEquipamentoDetails();
};
</script>
@endsection