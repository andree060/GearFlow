@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 font-weight-bold"
        style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
        Detalhes do Empréstimo
    </h1>

    <!-- Mensagem de Sucesso -->
    @if(session('success'))
    <div class="alert alert-success alert-custom" id="successAlert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Card com os detalhes do empréstimo -->
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <!-- Tabela de Detalhes -->
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID do Empréstimo</th>
                    <td>{{ $emprestimo->id }}</td>
                </tr>
                <tr>
                    <th>Equipamento</th>
                    <td>{{ $emprestimo->equipamento->nome ?? 'Equipamento não disponível' }}</td>
                </tr>
                <tr>
                    <th>Usuário</th>
                    <td>{{ $emprestimo->user->name ?? 'Usuário não disponível' }}</td>
                </tr>
                <tr>
                    <th>Data do Empréstimo</th>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Data de Devolução Prevista</th>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->data_devolucao_prevista)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Data de Devolução Real</th>
                    <td>{{ $emprestimo->data_devolucao_real ? \Carbon\Carbon::parse($emprestimo->data_devolucao_real)->format('d/m/Y') : 'Não devolvido' }}
                    </td>
                </tr>
                <tr>
                    <th>Data de Devolução</th>
                    <td>{{ $emprestimo->data_devolucao ? \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') : 'Não devolvido' }}
                    </td>
                </tr>
                <tr>
                    <th>Criado em</th>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->created_at)->format('d/m/Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Atualizado em</th>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->updated_at)->format('d/m/Y H:i:s') }}</td>
                </tr>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <!-- Botões Editar e Voltar -->
                <a href="{{ route('emprestimos.edit', $emprestimo->id) }}"
                    class="btn btn-warning w-auto shadow-sm rounded-pill text-white">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary w-auto shadow-sm rounded-pill">
                    <i class="fas fa-arrow-left"></i> Voltar
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