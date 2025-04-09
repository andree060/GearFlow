@extends('layouts.app')

@section('title', 'Cadastrar Equipamento')

@section('content')

    <div class="container mt-5">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4 text-primary">Cadastrar Equipamento</h1>
                <form action="{{ route('equipamentos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="numero_serie" class="form-label">Número de Série</label>
                        <input type="text" name="numero_serie" id="numero_serie" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="disponível">Disponível</option>
                            <option value="emprestado">Emprestado</option>
                            <option value="indisponível">Indisponível</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary" onclick="return confirm('Tem certeza que deseja cancelar?')">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Script adicional ou validações podem ser inseridos aqui
    </script>
@endsection
