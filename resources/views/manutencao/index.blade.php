@extends('layouts.app')

@section('title', 'Lista de Manutenções')

@section('content')

<!-- Título da página com cor personalizada -->
<h1 class="text-center mb-4 font-weight-bold"
    style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
    Lista de Manutenções
</h1>

<div class="container mt-5">

    <!-- Exibindo mensagem de sucesso -->
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tabela de Manutenções -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm rounded-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Equipamento</th>
                    <th>Data Manutenção</th>
                    <th>Responsável</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($manutencao as $manutencaos)
                <tr>
                    <td class="align-middle text-truncate" style="max-width: 100px;" title="{{ $manutencaos->id }}">
                        {{ $manutencaos->id }}
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 150px;"
                        title="{{ $manutencaos->equipamento->nome }}">
                        {{ $manutencaos->equipamento->nome }}
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 150px;"
                        title="{{ \Carbon\Carbon::parse($manutencaos->data_manutencao)->format('d/m/Y') }}">
                        {{ \Carbon\Carbon::parse($manutencaos->data_manutencao)->format('d/m/Y') }}
                    </td>
                    <td class="align-middle">{{ $manutencaos->responsavel }}</td>
                    <td class="align-middle text-truncate" style="max-width: 150px;" title="{{ $manutencaos->status }}">
                        {{ $manutencaos->status }}
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            <!-- Botão Visualizar -->
                            <a href="{{ route('manutencao.show', $manutencaos->id) }}"
                                class="btn btn-info btn-sm text-white px-2 py-1" title="Visualizar">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Botão Marcar como Concluída -->
                            @if($manutencaos->status != 'Manutenção Concluida')
                            <form action="{{ route('manutencao.update', $manutencaos->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Tem certeza que deseja marcar esta manutenção como concluída?')">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="equipamento_id" value="{{ $manutencaos->equipamento_id }}">
                                <input type="hidden" name="data_manutencao" value="{{ $manutencaos->data_manutencao }}">
                                <input type="hidden" name="descricao" value="{{ $manutencaos->descricao }}">
                                <input type="hidden" name="responsavel" value="{{ $manutencaos->responsavel }}">
                                <input type="hidden" name="status" value="Manutenção Concluida">
                                <input type="hidden" name="proxima_manutencao"
                                    value="{{ $manutencaos->proxima_manutencao }}">
                                <button type="submit" class="btn btn-success btn-sm text-white px-2 py-1"
                                    title="Marcar como concluída">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif

                            <!-- Botão Editar -->
                            <a href="{{ route('manutencao.edit', $manutencaos->id) }}"
                                class="btn btn-warning btn-sm text-white px-2 py-1" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Botão Excluir -->
                            <form action="{{ route('manutencao.destroy', $manutencaos->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Tem certeza que deseja excluir esta manutenção?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white px-2 py-1"
                                    title="Excluir">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botão de Voltar alinhado à direita -->
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('home.index') }}" class="btn btn-secondary w-auto shadow-sm rounded-pill"
            style="background-color: #6c757d; color: white;">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

</div>

@endsection

@section('scripts')
<!-- Scripts de confirmação -->
<script>
function confirmDelete() {
    return confirm('Tem certeza que deseja excluir esta manutenção?');
}

function confirmEdit() {
    return confirm('Tem certeza que deseja editar esta manutenção?');
}

function confirmMarkAsWorking() {
    return confirm('Tem certeza que deseja marcar esta manutenção como Concluída?');
}
</script>
@endsection