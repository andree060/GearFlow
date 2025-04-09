@extends('layouts.app')

@section('title', 'Editar Empréstimo')

@section('content')

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4 text-primary">Editar Empréstimo</h1>

                <!-- Mensagem de Sucesso -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulário de Edição do Empréstimo -->
                <form action="{{ route('emprestimos.update', $emprestimo->id) }}" method="POST" id="updateForm">
                    @csrf
                    @method('PUT') <!-- Método PUT para o update -->

                    <!-- Equipamento -->
                    <div class="mb-3">
                        <label for="equipamento_id" class="form-label">Equipamento</label>
                        <select name="equipamento_id" id="equipamento_id" class="form-select" required>
                            @foreach($equipamentos as $equipamento)
                                <option value="{{ $equipamento->id }}" {{ $emprestimo->equipamento_id == $equipamento->id ? 'selected' : '' }}>
                                    {{ $equipamento->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Usuário -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuário</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $emprestimo->usuario_id == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data do Empréstimo -->
                    <div class="mb-3">
                        <label for="data_emprestimo" class="form-label">Data do Empréstimo</label>
                        <input type="date" name="data_emprestimo" id="data_emprestimo" class="form-control" value="{{ $emprestimo->data_emprestimo }}" required>
                    </div>

                    <!-- Data de Devolução Prevista -->
                    <div class="mb-3">
                        <label for="data_devolucao_prevista" class="form-label">Data de Devolução Prevista</label>
                        <input type="date" name="data_devolucao_prevista" id="data_devolucao_prevista" class="form-control" value="{{ $emprestimo->data_devolucao_prevista }}" required>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="{{ route('emprestimos.show', $emprestimo->id) }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Função para exibir uma mensagem de sucesso
        function showSuccessAlert() {
            const successAlert = document.createElement('div');
            successAlert.className = 'alert alert-success mt-3';
            successAlert.innerHTML = 'Empréstimo atualizado com sucesso!';
            document.querySelector('.container').prepend(successAlert);
            
            setTimeout(() => {
                successAlert.remove();
            }, 5000); // Remove o alerta após 5 segundos
        }

        // Adiciona uma confirmação antes de enviar o formulário
        document.getElementById('updateForm').addEventListener('submit', function(event) {
            const confirmUpdate = confirm('Tem certeza que deseja atualizar este empréstimo?');
            if (!confirmUpdate) {
                event.preventDefault(); // Impede o envio do formulário caso o usuário não confirme
            } else {
                showSuccessAlert(); // Exibe o alerta de sucesso caso o formulário seja enviado
            }
        });
    </script>
@endsection
