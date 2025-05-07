@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body col-12 col-md-10 col-lg-8 mx-auto">
            <!-- Título estilizado -->
            <h1 class="text-center mb-4 text-primary text-uppercase fw-bold" style="letter-spacing: 1px;">
                Editar Usuário
            </h1>

            <!-- Mensagem de sucesso -->
            @if(session('success'))
            <div class="alert alert-success alert-custom shadow-sm rounded-pill px-4 py-2">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
            @endif

            <!-- Exibir mensagens de erro -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Formulário de edição -->
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" id="editUserForm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <div class="text-start">
                        <label for="name" class="form-label fw-semibold">Nome</label>
                    </div>
                    <input type="text" name="name" id="name" class="form-control shadow-sm rounded"
                        value="{{ old('name', $usuario->name) }}" required>
                </div>

                <div class="mb-3">
                    <div class="text-start">
                        <label for="email" class="form-label fw-semibold">Email</label>
                    </div>
                    <input type="email" name="email" id="email" class="form-control shadow-sm rounded"
                        value="{{ old('email', $usuario->email) }}" required>
                </div>

                <div class="mb-3">
                    <div class="text-start">
                        <label for="password" class="form-label fw-semibold">Senha</label>
                    </div>
                    <input type="password" name="password" id="password" class="form-control shadow-sm rounded"
                        placeholder="Digite uma nova senha">
                    <small class="form-text text-muted">Deixe em branco para manter a senha atual</small>
                </div>

                <div class="mb-3">
                    <div class="text-start">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmar Senha</label>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control shadow-sm rounded" placeholder="Confirme a nova senha">
                </div>

                <!-- Botões de ação -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4">
                        <i class="fas fa-save me-1"></i> Atualizar
                    </button>
                    <a href="{{ route('usuarios.show', $usuario->id) }}"
                        class="btn btn-secondary shadow-sm rounded-pill px-4" onclick="return confirmCancel()">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
// Função para confirmar o cancelamento do formulário
function confirmCancel() {
    return confirm('Tem certeza que deseja cancelar? As alterações não serão salvas.');
}

// Validação de senhas e campos obrigatórios antes de enviar o formulário
document.getElementById('editUserForm').addEventListener('submit', function(event) {
    var senha = document.getElementById('senha').value;
    var senhaConfirmation = document.getElementById('senha_confirmation').value;

    // Verificar se as senhas coincidem (somente se a senha foi preenchida)
    if (senha !== '' && senha !== senhaConfirmation) {
        alert('As senhas não coincidem.');
        event.preventDefault(); // Impede o envio do formulário
    }

    // Verificar se os campos obrigatórios estão preenchidos
    if (senha !== '' && senhaConfirmation === '') {
        alert('Por favor, confirme a senha.');
        event.preventDefault(); // Impede o envio do formulário
    }
});
</script>
@endsection