@extends('layouts.app')

@section('title', 'Cadastrar Empréstimo')

@section('content')

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
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

                <!-- Exibição de mensagens de erro para equipamento já emprestado -->
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
                                <option value="{{ $equipamento->id }}"
                                        data-categoria="{{ optional($equipamento->categoria)->nome }}"
                                        data-setor="{{ optional($equipamento->setor)->nome }}">
                                    {{ $equipamento->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Exibição da Categoria e Setor do Equipamento Selecionado -->
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <input type="text" id="categoria" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="setor" class="form-label">Setor</label>
                        <input type="text" name="setor_nome" id="setor" class="form-control" required>
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

@endsection

@section('scripts')
    <script>
        // Função para exibir a categoria e o setor automaticamente ao selecionar o equipamento
        function showEquipamentoDetails() {
            var equipamento = document.getElementById('equipamento_id').selectedOptions[0];
            document.getElementById('categoria').value = equipamento.getAttribute('data-categoria');
            document.getElementById('setor').value = equipamento.getAttribute('data-setor');
        }

        // Chama a função para preencher os campos ao carregar a página
        window.onload = function() {
            showEquipamentoDetails();
        };
    </script>
@endsection
