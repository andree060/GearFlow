@extends('layouts.app')

@section('title', 'Editar Manutenção')

@section('content')

    <div class="container mt-5">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <!-- Título com cor azul -->
                <h1 class="text-center mb-4 text-primary" style="font-size: 2.5rem;">Editar Manutenção</h1>

                <!-- Exibição de mensagens de sucesso -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulário de edição de manutenção -->
                <form action="{{ route('manutencao.update', $manutencao->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Método PUT para o update -->

                    <!-- Equipamento -->
                    <div class="mb-3">
                        <label for="equipamento_id" class="form-label">Equipamento</label>
                        <select name="equipamento_id" id="equipamento_id" class="form-control" required>
                            @foreach ($equipamentos as $equipamento)
                                <option value="{{ $equipamento->id }}" 
                                    @if($manutencao->equipamento_id == $equipamento->id) selected @endif>
                                    {{ $equipamento->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data da Manutenção -->
                    <div class="mb-3">
                        <label for="data_manutencao" class="form-label">Data Manutenção</label>
                        <input type="date" name="data_manutencao" id="data_manutencao" class="form-control" value="{{ $manutencao->data_manutencao }}" required>
                    </div>

                    <!-- Descrição -->
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea name="descricao" id="descricao" class="form-control" required>{{ $manutencao->descricao }}</textarea>
                    </div>

                    <!-- Responsável -->
                    <div class="mb-3">
                        <label for="responsavel" class="form-label">Responsável</label>
                        <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ $manutencao->responsavel }}" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Em Manutenção" @if($manutencao->status == 'Em Manutenção') selected @endif>Em Manutenção</option>
                            <option value="Funcionando" @if($manutencao->status == 'Funcionando') selected @endif>Funcionando</option>
                        </select>
                    </div>

                    <!-- Próxima Manutenção -->
                    <div class="mb-3">
                        <label for="proxima_manutencao" class="form-label">Próxima Manutenção</label>
                        <input type="date" name="proxima_manutencao" id="proxima_manutencao" class="form-control" value="{{ $manutencao->proxima_manutencao }}">
                    </div>

                    <!-- Custo (opcional) -->
                    <div class="mb-3">
                        <label for="custo" class="form-label">Custo</label>
                        <input type="text" name="custo" id="custo" class="form-control" value="{{ $manutencao->custo }}">
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary shadow-sm rounded-pill">Atualizar Manutenção</button>
                        <a href="{{ route('manutencao.index') }}" class="btn btn-secondary shadow-sm rounded-pill" style="background-color: #6c757d; color: white;">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
