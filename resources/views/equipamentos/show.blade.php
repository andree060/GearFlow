@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Título estilizado -->
    <h1 class="text-center mb-5 fw-bold text-dark text-uppercase"
        style="font-size: 2.5rem; letter-spacing: 1px; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);">
        Detalhes do Equipamento
    </h1>

    <!-- Alerta de sucesso -->
    @if(session('success'))
    <div class="alert alert-success d-flex align-items-center shadow-sm rounded-2">
        <i class="fas fa-check-circle me-2"></i>
        <div>{{ session('success') }}</div>
    </div>
    @endif

    <!-- Card de detalhes -->
    <div class="card shadow rounded-3 border-0">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tbody class="align-middle">
                    <tr>
                        <th class="bg-light text-dark text-start fw-semibold" style="width: 200px;">Nome</th>
                        <td>{{ $equipamento->nome }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark text-start fw-semibold">Número de Série</th>
                        <td>{{ $equipamento->numero_serie }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark text-start fw-semibold">Status</th>
                        <td>{{ $equipamento->status }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark text-start fw-semibold">Setor</th>
                        <td>{{ $equipamento->setor->nome ?? 'Não definido' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark text-start fw-semibold">Categoria</th>
                        <td>{{ $equipamento->categoria->nome ?? 'Não definida' }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Ações -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('equipamentos.edit', $equipamento->id) }}"
                    class="btn btn-warning text-white rounded-pill px-4 shadow-sm">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
                <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Exibe o alerta de sucesso
function showSuccessAlert() {
    const successAlert = document.getElementById('successAlert');
    successAlert.style.display = 'block';

    // Esconde o alerta após 5 segundos
    setTimeout(function() {
        successAlert.style.display = 'none';
    }, 5000);
}
</script>
@endsection