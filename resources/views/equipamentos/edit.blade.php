@extends('layouts.app')

@section('title', 'Editar Equipamento')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card shadow-sm">
            <div class="card-body col-12 col-md-10 col-lg-8 mx-auto">
                <h1 class="text-center mb-5 fw-bold text-primary text-uppercase" style="letter-spacing: 1px;">
                    Editar Equipamento
                </h1>

                @if(session('success'))
                <div class="alert alert-success d-flex align-items-center shadow-sm rounded-2">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('equipamentos.update', $equipamento->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <div class="text-start">
                            <label for="nome" class="form-label fw-semibold text-dark" style="font-size: 1rem;">Nome
                                do Equipamento</label>
                        </div>
                        <input type="text" name="nome" id="nome" class="form-control shadow-sm rounded-2"
                            value="{{ old('nome', $equipamento->nome) }}" required>
                    </div>

                    <!-- Agrupando Número de Série e Status -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="text-start">
                                <label for="numero_serie" class="form-label fw-semibold text-dark"
                                    style="font-size: 1rem;">Número de Série</label>
                            </div>
                            <input type="text" name="numero_serie" id="numero_serie"
                                class="form-control shadow-sm rounded-2"
                                value="{{ old('numero_serie', $equipamento->numero_serie) }}" required>
                        </div>
                        <div class="col-md-6">
                            <div class="text-start">
                                <label for="status" class="form-label fw-semibold text-dark"
                                    style="font-size: 1rem;">Status</label>
                            </div>
                            <select name="status" id="status" class="form-select shadow-sm rounded-2" required>
                                <option value="disponível" {{ $equipamento->status == 'disponível' ? 'selected' : '' }}>
                                    Disponível</option>
                                <option value="emprestado" {{ $equipamento->status == 'emprestado' ? 'selected' : '' }}>
                                    Emprestado</option>
                                <option value="indisponível"
                                    {{ $equipamento->status == 'indisponível' ? 'selected' : '' }}>
                                    Indisponível</option>
                            </select>
                        </div>
                    </div>

                    <!-- Agrupando Setor e Categoria -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="text-start">
                                <label for="setor_id" class="form-label fw-semibold text-dark"
                                    style="font-size: 1rem;">Setor</label>
                            </div>
                            <select name="setor_id" id="setor_id" class="form-select shadow-sm rounded-2" required>
                                @foreach ($setores as $setor)
                                <option value="{{ $setor->id }}"
                                    {{ $equipamento->setor_id == $setor->id ? 'selected' : '' }}>
                                    {{ $setor->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="text-start">
                                <label for="categoria_nome" class="form-label fw-semibold text-dark"
                                    style="font-size: 1rem;">Categoria</label>
                            </div>
                            <input type="text" name="categoria_nome" id="categoria_nome"
                                class="form-control shadow-sm rounded-2"
                                value="{{ old('categoria_nome', $equipamento->categoria->nome ?? '') }}" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                            <i class="fas fa-save me-1"></i> Atualizar
                        </button>
                        <a href="{{ route('equipamentos.index') }}"
                            class="btn btn-secondary px-4 rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Scripts adicionais podem ser adicionados aqui
</script>
@endsection