@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4 font-weight-bold" style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
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
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipamentos as $equipamento)
                        <tr>
                            <td class="align-middle">{{ $equipamento->id }}</td>
                            <td class="align-middle">{{ $equipamento->nome }}</td>
                            <td class="align-middle">{{ $equipamento->numero_serie }}</td>
                            <td class="align-middle">
                                <span class="badge
                                    {{ strtolower($equipamento->status) == 'disponível' ? 'bg-success' : 'bg-danger' }}
                                    badge-custom">
                                    @if(strtolower($equipamento->status) == 'disponível')
                                        <i class="fas fa-check-circle"></i> Disponível
                                    @else
                                        <i class="fas fa-times-circle"></i> Indisponível
                                    @endif
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ route('equipamentos.show', $equipamento->id) }}" class="btn btn-info w-100 shadow-sm rounded-pill text-white">
                                        <i class="fas fa-eye"></i> Visualizar
                                    </a>
                                    <a href="{{ route('equipamentos.edit', $equipamento->id) }}" class="btn btn-warning w-100 shadow-sm rounded-pill text-white" onclick="return confirmEdit()">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100 shadow-sm rounded-pill text-white">
                                            <i class="fas fa-trash-alt"></i> Excluir
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
            <a href="{{ route('home.index') }}" class="btn btn-secondary w-auto shadow-sm rounded-pill" style="background-color: #6c757d; color: white;">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
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
