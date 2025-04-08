@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4 font-weight-bold" style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
            Lista de Empréstimos
        </h1>

        <div class="alert alert-success alert-custom" id="successAlert" style="display:none;">
            <i class="fas fa-check-circle me-2"></i> Empréstimo excluído com sucesso!
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover shadow-sm rounded-3">
                <thead class="table-dark">
                    <tr>
                        <th>Equipamento</th>
                        <th>Usuário</th>
                        <th>Data Empréstimo</th>
                        <th>Devolvido</th> <!-- Nova coluna para mostrar "Sim" se foi devolvido -->
                        <th>Data Devolução</th> <!-- Exibe a data de devolução -->
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprestimos as $emprestimo)
                        <tr class="table-row">
                            <td class="align-middle">{{ $emprestimo->equipamento->nome }}</td>
                            <td class="align-middle">{{ $emprestimo->user->name }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                            <td class="align-middle">
                                @if($emprestimo->data_devolucao)
                                    <!-- Exibe "Sim" se o empréstimo foi devolvido -->
                                    <span class="badge bg-success rounded-pill">
                                        <i class="fas fa-check-circle"></i> Sim
                                    </span>
                                @else
                                    <!-- Exibe "Não" caso contrário -->
                                    <span class="badge bg-danger rounded-pill">
                                        <i class="fas fa-times-circle"></i> Não
                                    </span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if($emprestimo->data_devolucao)
                                    {{ \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ route('emprestimos.show', $emprestimo->id) }}" class="btn btn-info w-100 shadow-sm rounded-pill text-white">
                                        <i class="fas fa-eye"></i> Visualizar
                                    </a>
                                    <a href="{{ route('emprestimos.edit', $emprestimo->id) }}" class="btn btn-warning w-100 shadow-sm rounded-pill text-white">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('emprestimos.destroy', $emprestimo->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100 shadow-sm rounded-pill text-white">
                                            <i class="fas fa-trash-alt"></i> Excluir
                                        </button>
                                    </form>

                                    <!-- Botão Devolver Equipamento -->
                                    @if(!$emprestimo->data_devolucao)
                                        <form action="{{ route('emprestimos.update', $emprestimo->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="devolver" value="true">
                                            <button type="submit" class="btn btn-primary w-100 shadow-sm rounded-pill text-white">
                                                <i class="fas fa-undo"></i> Devolver Equipamento
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

        <div class="d-flex justify-content-end">
            <a href="{{ route('home.index') }}" class="btn btn-secondary w-auto shadow-sm rounded-pill">Voltar</a>
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
                event.preventDefault(); // Impede o envio imediato

                if (confirm('Tem certeza que deseja excluir este empréstimo?')) {
                    this.submit();
                    showSuccessAlert();
                }
            });
        });
    </script>
@endsection
