@extends('layouts.app')

@section('title', 'Cadastrar Manutenção')

@section('content')

    <!-- Container principal -->
    <div class="container mt-5">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <!-- Título com cor azul -->
                <h1 class="text-center mb-4 text-primary" style="font-size: 2.5rem;">Cadastrar Manutenção</h1>

                <!-- Formulário de cadastro de manutenção -->
                <form action="{{ route('manutencao.store') }}" method="POST">
                    @csrf

                    <!-- Equipamento -->
                    <div class="mb-3">
                        <label for="equipamento_id" class="form-label">Equipamento</label>
                        <select name="equipamento_id" id="equipamento_id" class="form-control" required>
                            @foreach ($equipamentos as $equipamento)
                                <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data da Manutenção -->
                    <div class="mb-3">
                        <label for="data_manutencao" class="form-label">Data Manutenção</label>
                        <input type="date" name="data_manutencao" id="data_manutencao" class="form-control" required>
                    </div>

                    <!-- Descrição -->
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea name="descricao" id="descricao" class="form-control" required></textarea>
                    </div>

                    <!-- Responsável -->
                    <div class="mb-3">
                        <label for="responsavel" class="form-label">Responsável</label>
                        <input type="text" name="responsavel" id="responsavel" class="form-control" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Em Manutenção" selected>Em Manutenção</option>
                            <option value="Funcionando">Funcionando</option>
                        </select>
                    </div>

                    <!-- Próxima Manutenção -->
                    <div class="mb-3">
                        <label for="proxima_manutencao" class="form-label">Próxima Manutenção</label>
                        <input type="date" name="proxima_manutencao" id="proxima_manutencao" class="form-control">
                    </div>

                    <!-- Custo (opcional) -->
                    <div class="mb-3">
                        <label for="custo" class="form-label">Custo</label>
                        <input type="text" name="custo" id="custo" class="form-control">
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary w-48 shadow-sm rounded-pill">Cadastrar Manutenção</button>
                        <a href="{{ route('manutencao.index') }}" class="btn btn-secondary w-48 shadow-sm rounded-pill" style="background-color: #6c757d; color: white;" onclick="return confirmCancel()">Voltar</a>
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
    </script>
@endsection
