@extends('layouts.app')

@section('title', 'Cadastrar Usuário')

@section('content')

    <!-- Container principal -->
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Título com cor azul -->
                <h1 class="text-center mb-4 text-primary">Cadastrar Usuário</h1>

                <!-- Formulário de cadastro de usuário -->
                <form action="{{ route('usuarios.store') }}" method="POST" id="userForm">
                    @csrf <!-- Token CSRF para segurança -->

                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <!-- Confirmação de Senha -->
                    <div class="mb-3">
                        <label for="senha_confirmation" class="form-label">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary w-48" id="submitBtn">Salvar</button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary w-48" onclick="return confirmCancel()">Voltar</a>
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
