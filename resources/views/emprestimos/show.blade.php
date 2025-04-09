@extends('layouts.app')

@section('content')
    <!-- Título da página com design moderno -->
    <div class="container mt-5">
        <h1 class="text-center mb-4 font-weight-bold" style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
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
                        <th>Equipamento</th>
                        <td>{{ $emprestimo->equipamento->nome }}</td>
                    </tr>
                    <tr>
                        <th>Usuário</th>
                        <td>{{ $emprestimo->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Data do Empréstimo</th>
                        <td>{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Data de Devolução Prevista</th>
                        <td>{{ \Carbon\Carbon::parse($emprestimo->data_devolucao_prevista)->format('d/m/Y') }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-start gap-2">
                    <!-- Botões Editar e Voltar -->
                    <a href="{{ route('emprestimos.edit', $emprestimo->id) }}" class="btn btn-warning w-auto shadow-sm rounded-pill text-white">
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
