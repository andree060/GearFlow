@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 font-weight-bold"
        style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
        Lista de Equipamentos
    </h1>

    <!-- Mensagem de Alerta de Sucesso -->
    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Tabela de Equipamentos -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm rounded-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Número de Série</th>
                    <th>Status</th>
                    <th>Categoria</th>
                    <th>Setor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipamentos as $equipamento)
                <tr>
                    <td class="align-middle text-truncate" style="max-width: 100px;" title="{{ $equipamento->id }}">
                        {{ $equipamento->id }}
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 150px;" title="{{ $equipamento->nome }}">
                        {{ $equipamento->nome }}
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 150px;"
                        title="{{ $equipamento->numero_serie }}">
                        {{ $equipamento->numero_serie }}
                    </td>
                    <td class="align-middle">
                        <span class="badge
                                {{ strtolower($equipamento->status) == 'disponível' ? 'bg-success' : 'bg-danger' }}
                                badge-custom" title="{{ ucfirst($equipamento->status) }}">
                            @if(strtolower($equipamento->status) == 'disponível')
                            <i class="fas fa-check-circle"></i> Disponível
                            @else
                            <i class="fas fa-times-circle"></i> Indisponível
                            @endif
                        </span>
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 150px;"
                        title="{{ $equipamento->categoria->nome ?? 'Não definida' }}">
                        {{ $equipamento->categoria->nome ?? 'Não definida' }}
                    </td>
                    <td class="align-middle text-truncate" style="max-width: 150px;"
                        title="{{ $equipamento->setor->nome ?? 'Não definido' }}">
                        {{ $equipamento->setor->nome ?? 'Não definido' }}
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            <a href="{{ route('equipamentos.show', $equipamento->id) }}"
                                class="btn btn-info btn-sm text-white px-2 py-1" title="Visualizar">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('equipamentos.edit', $equipamento->id) }}"
                                class="btn btn-warning btn-sm text-white px-2 py-1" onclick="return confirmEdit()"
                                title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST"
                                onsubmit="return confirmDelete()" class="d-inline">
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

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('home.index') }}" class="btn btn-secondary w-auto shadow-sm rounded-pill"
            style="background-color: #6c757d; color: white;">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    @endsection

    @section('scripts')
    <script>
    // Confirmação para a exclusão
    function confirmDelete() {
        return confirm('Tem certeza que deseja excluir este equipamento?');
    }

    // Confirmação para a edição
    function confirmEdit() {
        return confirm('Tem certeza que deseja editar este equipamento?');
    }
    </script>
    @endsection