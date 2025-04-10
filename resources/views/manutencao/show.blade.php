@extends('layouts.app')

@section('title', 'Detalhes da Manutenção')

@section('content')

    <!-- Título da página com cor personalizada -->
    <h1 class="text-center mb-4 font-weight-bold" style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
        Detalhes da Manutenção
    </h1>

    <div class="container mt-5">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cartão com detalhes da manutenção -->
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <!-- Tabela de detalhes -->
                <table class="table table-striped">
                    <tr>
                        <th>ID da Manutenção</th>
                        <td>{{ $manutencao->id }}</td>
                    </tr>
                    <tr>
                        <th>Equipamento</th>
                        <td>{{ $manutencao->equipamento->nome }}</td>
                    </tr>
                    <tr>
                        <th>Data da Manutenção</th>
                        <td>{{ \Carbon\Carbon::parse($manutencao->data_manutencao)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Descrição</th>
                        <td>{{ $manutencao->descricao }}</td>
                    </tr>
                    <tr>
                        <th>Responsável</th>
                        <td>{{ $manutencao->responsavel }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $manutencao->status }}</td>
                    </tr>
                    <tr>
                        <th>Custo</th>
                        <td>R$ {{ number_format($manutencao->custo ?? 0, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Próxima Manutenção</th>
                        <td>
                            @if($manutencao->proxima_manutencao)
                                {{ \Carbon\Carbon::parse($manutencao->proxima_manutencao)->format('d/m/Y') }}
                            @else
                                Não definida
                            @endif
                        </td>
                    </tr>
                </table>

                <!-- Botões de Ação -->
                <div class="d-flex justify-content-start gap-3">
                    <!-- Botão Editar -->
                    <a href="{{ route('manutencao.edit', $manutencao->id) }}" class="btn btn-warning shadow-sm rounded-pill text-white">
                        <i class="fas fa-edit"></i> Editar
                    </a>

                    <!-- Formulário Excluir -->
                    <form action="{{ route('manutencao.destroy', $manutencao->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger shadow-sm rounded-pill text-white">
                            <i class="fas fa-trash-alt"></i> Excluir
                        </button>
                    </form>

                    

                    <!-- Botão Voltar -->
                    <a href="{{ route('manutencao.index') }}" class="btn btn-secondary shadow-sm rounded-pill" style="background-color: #6c757d; color: white;">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <!-- Script para confirmação de exclusão -->
    <script>
        function confirmDelete() {
            return confirm('Tem certeza que deseja excluir esta manutenção?');
        }
    </script>
@endsection
