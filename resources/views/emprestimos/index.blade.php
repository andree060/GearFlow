@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 font-weight-bold"
        style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
        Lista de Empréstimos
    </h1>

    <div class="alert alert-success alert-custom" id="successAlert" style="display:none;">
        <i class="fas fa-check-circle me-2"></i> Empréstimo excluído com sucesso!
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm rounded-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Equipamento</th>
                    <th>Usuário</th>
                    <th>Data Empréstimo</th>
                    <th>Devolvido</th>
                    <th>Data Devolução</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emprestimos as $emprestimo)
                <tr>
                    <td class="align-middle text-truncate" style="max-width: 50px;" title="{{ $emprestimo->id }}">
                        {{ $emprestimo->id }}
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 150px;"
                        title="{{ $emprestimo->equipamento->nome ?? 'Equipamento não disponível' }}">
                        {{ $emprestimo->equipamento->nome ?? 'Equipamento não disponível' }}
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 150px;"
                        title="{{ $emprestimo->user->name }}">
                        {{ $emprestimo->user->name }}
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 120px;"
                        title="{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}">
                        {{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}
                    </td>
                    <td class="align-middle">
                        <span class="badge {{ $emprestimo->data_devolucao ? 'bg-success' : 'bg-danger' }} rounded-pill"
                            title="{{ $emprestimo->data_devolucao ? 'Sim' : 'Não' }}">
                            <i
                                class="fas {{ $emprestimo->data_devolucao ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                            {{ $emprestimo->data_devolucao ? 'Sim' : 'Não' }}
                        </span>
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 120px;"
                        title="{{ $emprestimo->data_devolucao ? \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') : 'N/A' }}">
                        {{ $emprestimo->data_devolucao ? \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') : 'N/A' }}
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            <a href="{{ route('emprestimos.show', $emprestimo->id) }}"
                                class="btn btn-info btn-sm text-white px-2 py-1" title="Visualizar">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('emprestimos.edit', $emprestimo->id) }}"
                                class="btn btn-warning btn-sm text-white px-2 py-1" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('emprestimos.destroy', $emprestimo->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Tem certeza que deseja excluir este empréstimo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white px-2 py-1"
                                    title="Excluir">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @if(!$emprestimo->data_devolucao)
                            <form action="{{ route('emprestimos.update', $emprestimo->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Tem certeza que deseja devolver este equipamento?')">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="devolver" value="true">
                                <button type="submit" class="btn btn-primary btn-sm text-white px-2 py-1"
                                    title="Devolver">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('home.index') }}" class="btn btn-secondary w-auto shadow-sm rounded-pill"
            style="background-color: #6c757d; color: white;">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Exibe o alerta de sucesso
function showSuccessAlert() {
    const successAlert = document.getElementById('successAlert');
    successAlert.style.display = 'block';

    setTimeout(function() {
        successAlert.style.display = 'none';
    }, 5000);
}

// Confirma a exclusão antes de enviar o formulário
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        if (confirm('Tem certeza que deseja excluir este empréstimo?')) {
            this.submit();
            showSuccessAlert();
        }
    });
});

// Confirma a devolução antes de enviar o formulário
document.querySelectorAll('.devolver-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        if (confirm('Tem certeza que deseja devolver este equipamento?')) {
            this.submit();
        }
    });
});
</script>
@endsection