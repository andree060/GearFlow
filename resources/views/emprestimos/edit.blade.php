@extends('layouts.app')

@section('title', 'Editar Empréstimo')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body col-12 col-md-10 col-lg-8 mx-auto">
            <h1 class="text-center mb-4 text-primary text-uppercase fw-bold"
                style="font-size: 2.5rem; letter-spacing: 1px;">
                Editar Empréstimo
            </h1>

            <!-- Mensagem de Sucesso -->
            @if(session('success'))
            <div class="alert alert-success shadow-sm rounded">
                {{ session('success') }}
            </div>
            @endif

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

            <!-- Formulário de Edição -->
            <form action="{{ route('emprestimos.update', $emprestimo->id) }}" method="POST" id="updateForm">
                @csrf
                @method('PUT')

                <!-- Equipamento -->
                <div class="mb-3">
                    <div class="text-start">
                        <label for="equipamento_id" class="form-label fw-semibold">Equipamento</label>
                    </div>
                    <select name="equipamento_id" id="equipamento_id" class="form-control shadow-sm rounded" required>
                        @foreach($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}"
                            {{ $emprestimo->equipamento_id == $equipamento->id ? 'selected' : '' }}>
                            {{ $equipamento->nome }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Usuário -->
                <div class="mb-3">
                    <div class="text-start">
                        <label for="user_id" class="form-label fw-semibold">Usuário</label>
                    </div>
                    <select name="user_id" id="user_id" class="form-control shadow-sm rounded" required>
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}"
                            {{ $emprestimo->usuario_id == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Agrupamento de datas -->
                <div class="row mb-3">
                    <!-- Data do Empréstimo -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="text-start">
                            <label for="data_emprestimo" class="form-label fw-semibold">Data do Empréstimo</label>
                        </div>
                        <input type="date" name="data_emprestimo" id="data_emprestimo"
                            class="form-control shadow-sm rounded" value="{{ $emprestimo->data_emprestimo }}" required>
                    </div>

                    <!-- Data de Devolução Prevista -->
                    <div class="col-md-6">
                        <div class="text-start">
                            <label for="data_devolucao_prevista" class="form-label fw-semibold">Data de Devolução
                                Prevista</label>
                        </div>
                        <input type="date" name="data_devolucao_prevista" id="data_devolucao_prevista"
                            class="form-control shadow-sm rounded" value="{{ $emprestimo->data_devolucao_prevista }}"
                            required>
                    </div>
                </div>

                <!-- Botões -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4">
                        <i class="fas fa-sync-alt me-1"></i> Atualizar
                    </button>

                    <a href="{{ route('emprestimos.show', $emprestimo->id) }}"
                        class="btn btn-secondary shadow-sm rounded-pill px-4">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
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