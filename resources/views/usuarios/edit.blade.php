@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Título com cor azul -->
                <h1 class="text-center mb-4 text-primary">Editar Usuário</h1>

                <!-- Exibição de mensagens de sucesso -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulário de edição de usuário -->
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT') <!-- Método PUT para o update -->

                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $usuario->nome) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control">
                        <small>Deixe em branco para manter a senha atual</small>
                    </div>

                    <!-- Confirmação de Senha -->
                    <div class="mb-3">
                        <label for="senha_confirmation" class="form-label">Confirmar Senha</label>
                        <input type="password" name="senha_confirmation" id="senha_confirmation" class="form-control">
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Atualizar</button>

                        <!-- Link de Cancelar com confirmação -->
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-secondary" onclick="return confirmCancel()">
                            Cancelar
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
