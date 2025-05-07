@extends('layouts.app')

@section('title', 'Cadastrar Usuário')

@section('content')

<!-- Container principal -->
<div class="container mt-5">
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <!-- Título com cor azul -->
            <h1 class="text-center mb-4 text-primary">Cadastrar Usuário</h1>
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

            <!-- Formulário de cadastro de usuário -->
            <form action="{{ route('usuarios.store') }}" method="POST" id="userForm">
                @csrf
                <!-- Token CSRF para segurança -->

                <!-- Container para o formulário ocupar col-8 -->
                <div class="col-8 mx-auto">

                    <!-- Nome -->
                    <div class="mb-3">
                        <div class="text-start ps-1">
                            <label for="name" class="form-label fw-bold">Nome</label>
                        </div>
                        <input type="text" name="name" id="name" class="form-control" required
                            placeholder="Digite o nome completo">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <div class="text-start ps-1">
                            <label for="email" class="form-label fw-bold">Email</label>
                        </div>
                        <input type="email" name="email" id="email" class="form-control" required
                            placeholder="Digite o seu email">
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <div class="text-start ps-1">
                            <label for="password" class="form-label fw-bold">Senha</label>
                        </div>
                        <input type="password" name="password" id="password" class="form-control" required
                            placeholder="Digite uma senha">
                    </div>

                    <!-- Confirmação de Senha -->
                    <div class="mb-3">
                        <div class="text-start ps-1">
                            <label for="password_confirmation" class="form-label fw-bold">Confirmar Senha</label>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" required placeholder="Confirme a senha">
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill"
                            id="submitBtn">Salvar</button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill"
                            onclick="return confirmCancel()">
                            Voltar
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



<!-- Exibição de mensagens de sucesso ou erro -->
@if(session('success'))
<div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

@endsection

@section('scripts')
<script>
// Função para confirmar o cancelamento do formulário
function confirmCancel() {
    return confirm('Tem certeza que deseja cancelar? As alterações não serão salvas.');
}

// Validação de campos do formulário antes de enviar
document.getElementById('userForm').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var passwordConfirmation = document.getElementById('password_confirmation').value;
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;

    // Verificar se todos os campos obrigatórios estão preenchidos
    if (!name || !email || !password || !passwordConfirmation) {
        alert('Por favor, preencha todos os campos obrigatórios.');
        event.preventDefault(); // Impede o envio do formulário
    }

    // Verificar se as senhas coincidem
    if (password !== passwordConfirmation) {
        alert('As senhas não coincidem.');
        event.preventDefault(); // Impede o envio do formulário
    }
});
</script>
@endsection