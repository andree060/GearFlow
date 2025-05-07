@extends('layouts.app')

@section('title', 'Cadastrar Manutenção')

@section('content')

<!-- Container principal -->
<div class="container mt-5">
    <div class="card shadow-sm rounded-3">
        <div class="card-body col-12 col-md-10 col-lg-8 mx-auto">
            <!-- Título estilizado -->
            <h1 class="text-center mb-4 text-primary text-uppercase fw-bold"
                style="font-size: 2.5rem; letter-spacing: 1px;">
                Cadastrar Manutenção
            </h1>
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
            <form action="{{ route('manutencao.store') }}" method="POST">
                @csrf

                <!-- Equipamento -->
                <div class="mb-3">
                    <div class="text-start">
                        <label for="equipamento_id" class="form-label fw-semibold">Equipamento</label>
                    </div>
                    <select name="equipamento_id" id="equipamento_id" class="form-control shadow-sm rounded" required>
                        @foreach ($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Descrição -->
                <div class="mb-3">
                    <div class="text-start">
                        <label for="descricao" class="form-label fw-semibold">Descrição</label>
                    </div>
                    <textarea name="descricao" id="descricao" class="form-control shadow-sm rounded" rows="3" required
                        placeholder="Digite a a descriçào aqui"></textarea>
                </div>

                <!-- Responsável -->
                <div class=" mb-3">
                    <div class="text-start">
                        <label for="responsavel" class="form-label fw-semibold">Responsável</label>
                    </div>
                    <input type="text" name="responsavel" id="responsavel" class="form-control shadow-sm rounded"
                        required>
                </div>

                <!-- Linha: Data Manutenção + Próxima Manutenção -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="data_manutencao" class="form-label fw-semibold">Data Manutenção</label>
                        </div>
                        <input type="date" name="data_manutencao" id="data_manutencao"
                            class="form-control shadow-sm rounded" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="proxima_manutencao" class="form-label fw-semibold">Próxima Manutenção</label>
                        </div>
                        <input type="date" name="proxima_manutencao" id="proxima_manutencao"
                            class="form-control shadow-sm rounded">
                    </div>
                </div>

                <!-- Linha: Status + Custo -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="status" class="form-label fw-semibold">Status</label>
                        </div>
                        <select name="status" id="status" class="form-control shadow-sm rounded" required>
                            <option value="Em Manutenção" selected>Em Manutenção</option>
                            <option value="Manutenção Concluida">Manutenção Concluída</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="text-start">
                            <label for="custo" class="form-label fw-semibold">Custo</label>
                        </div>
                        <input type="text" name="custo" id="custo" class="form-control shadow-sm rounded"
                            placeholder="R$ 0,00" required>
                    </div>
                </div>

                <!-- Botões -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4">
                        <i class="fas fa-save me-1"></i> Cadastrar
                    </button>

                    <a href="{{ route('manutencao.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4"
                        onclick="return confirmCancel()">
                        <i class="fas fa-arrow-left me-1"></i> Voltar
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
</script>
@endsection