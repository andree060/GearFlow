@extends('layouts.app')

@section('title', 'Editar Manutenção')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm rounded-3">
        <div class="card-body col-12 col-md-10 col-lg-8 mx-auto">
            <!-- Título -->
            <h1 class="text-center mb-4 text-primary text-uppercase fw-bold"
                style="font-size: 2.5rem; letter-spacing: 1px;">
                Editar Manutenção
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

            <!-- Formulário -->
            <form action="{{ route('manutencao.update', $manutencao->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Equipamento -->
                <div class="mb-3">
                    <div class="text-start">
                        <label for="equipamento_id" class="form-label fw-semibold">Equipamento</label>
                    </div>
                    <select name="equipamento_id" id="equipamento_id" class="form-control shadow-sm rounded" required>
                        @foreach ($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}" @if($manutencao->equipamento_id == $equipamento->id)
                            selected @endif>
                            {{ $equipamento->nome }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Agrupamento de datas -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="text-start">
                            <label for="data_manutencao" class="form-label fw-semibold">Data da Manutenção</label>
                        </div>
                        <input type="date" name="data_manutencao" id="data_manutencao"
                            class="form-control shadow-sm rounded" value="{{ $manutencao->data_manutencao }}" required>
                    </div>

                    <div class="col-md-6">
                        <div class="text-start">
                            <label for="proxima_manutencao" class="form-label fw-semibold">Próxima Manutenção</label>
                        </div>
                        <input type="date" name="proxima_manutencao" id="proxima_manutencao"
                            class="form-control shadow-sm rounded" value="{{ $manutencao->proxima_manutencao }}">
                    </div>
                </div>

                <!-- Descrição -->
                <div class="mb-3">
                    <div class="text-start">
                        <label for="descricao" class="form-label fw-semibold">Descrição</label>
                    </div>
                    <textarea name="descricao" id="descricao" rows="3" class="form-control shadow-sm rounded"
                        required>{{ $manutencao->descricao }}</textarea>
                </div>

                <!-- Responsável e Custo -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="text-start">
                            <label for="responsavel" class="form-label fw-semibold">Responsável</label>
                        </div>
                        <input type="text" name="responsavel" id="responsavel" class="form-control shadow-sm rounded"
                            value="{{ $manutencao->responsavel }}" required>
                    </div>

                    <div class="col-md-6">
                        <div class="text-start">
                            <label for="custo_mascarado" class="form-label fw-semibold">Custo</label>
                        </div>
                        <input type="text" id="custo_mascarado" class="form-control shadow-sm rounded"
                            placeholder="R$ 0,00" required>
                        <input type="hidden" name="custo" id="custo_real" value="{{ $manutencao->custo }}">
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <div class="text-start">
                        <label for="status" class="form-label fw-semibold">Status</label>
                    </div>
                    <select name="status" id="status" class="form-control shadow-sm rounded" required>
                        <option value="Em Manutenção" @if($manutencao->status == 'Em Manutenção') selected @endif>Em
                            Manutenção</option>
                        <option value="Manutenção Concluida" @if($manutencao->status == 'Manutenção Concluida') selected
                            @endif>Manutenção Concluída</option>
                    </select>
                </div>

                <!-- Botões -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4">
                        <i class="fas fa-sync-alt me-1"></i> Atualizar Manutenção
                    </button>

                    <a href="{{ route('manutencao.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4">
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
document.addEventListener('DOMContentLoaded', function() {
    const inputVisivel = document.getElementById('custo_mascarado');
    const inputReal = document.getElementById('custo_real');

    // Formata o valor já existente
    if (inputReal.value) {
        let valor = parseFloat(inputReal.value).toFixed(2);
        inputVisivel.value = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(valor);
    }

    inputVisivel.addEventListener('input', function() {
        let rawValue = inputVisivel.value.replace(/\D/g, '');

        if (rawValue.length === 0) {
            inputVisivel.value = '';
            inputReal.value = '';
            return;
        }

        let valor = (parseInt(rawValue, 10) / 100).toFixed(2);
        let valorFormatado = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(valor);

        inputVisivel.value = valorFormatado;
        inputReal.value = valor;
    });
});
</script>
@endsection