@extends('layouts.app')

@section('title', 'Relatórios - Sistema de Empréstimos')

@section('content')
    <!-- Cabeçalho de Relatório -->
    <h1 class="text-center mb-4 font-weight-bold" style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
        Relatórios de Equipamentos e Empréstimos
    </h1>

    <!-- Filtro de Data -->
    <form method="GET" action="{{ route('relatorio.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="data_inicio">Data Início:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ $dataInicio ? $dataInicio->format('Y-m-d') : '' }}">
            </div>
            <div class="col-md-3">
                <label for="data_fim">Data Fim:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{ $dataFim ? $dataFim->format('Y-m-d') : '' }}">
            </div>
            <div class="col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Exibindo as Datas Selecionadas -->
    @if ($dataInicio && $dataFim)
        <div class="alert alert-info text-center mb-4">
            <strong>Período Selecionado:</strong> {{ $dataInicio->format('d/m/Y') }} até {{ $dataFim->format('d/m/Y') }}
        </div>
    @elseif ($dataInicio)
        <div class="alert alert-info text-center mb-4">
            <strong>Data de Início:</strong> {{ $dataInicio->format('d/m/Y') }}
        </div>
    @elseif ($dataFim)
        <div class="alert alert-info text-center mb-4">
            <strong>Data de Fim:</strong> {{ $dataFim->format('d/m/Y') }}
        </div>
    @endif

    <!-- Tabela de Empréstimos -->
    @if($dataInicio && $dataFim)
        @if($emprestimos->count() > 0)
        <table class="table table-hover table-striped table-bordered" style="border-radius: 10px; overflow: hidden;">
            <thead class="thead-dark" style="background-color: #007bff; color: white;">
                <tr>
                    <th>Data de Empréstimo</th>
                    <th>Usuário</th>
                    <th>Equipamento</th>
                    <th>Status do Equipamento</th>
                </tr>
            </thead>
            <tbody>
            @foreach($emprestimos as $emprestimo)
                <tr>
                    <td class="text-center">{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->user->name }}</td>
                    <td>{{ $emprestimo->equipamento ? $emprestimo->equipamento->nome : 'Equipamento não atribuído' }}</td>
                    <td class="text-center">
                        @if($emprestimo->equipamento && $emprestimo->equipamento->status == 'disponível')
                            <span class="badge bg-success">Disponível</span>
                        @elseif($emprestimo->equipamento && $emprestimo->equipamento->status == 'indisponível')
                            <span class="badge bg-danger">Indisponível</span>
                        @elseif($emprestimo->equipamento && $emprestimo->equipamento->status == 'emprestado')
                            <span class="badge bg-warning">Emprestado</span>
                        @else
                            <span class="badge bg-danger">Indisponível</span>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        @else
            <div class="alert alert-warning text-center">
                Nenhum empréstimo encontrado para o período selecionado.
            </div>
        @endif
    @endif

    <!-- Visão Geral dos Dados -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
        <!-- Cartão de Equipamentos Totais -->
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Equipamentos Totais</h5>
                    <p class="card-text display-4">{{ $totalEquipamentos }}</p>
                </div>
            </div>
        </div>

        <!-- Cartão de Equipamentos Disponíveis -->
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Equipamentos Disponíveis</h5>
                    <p class="card-text display-4">{{ $totalEquipamentosDisponiveis }}</p>
                </div>
            </div>
        </div>

        <!-- Cartão de Equipamentos Emprestados -->
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Equipamentos Emprestados</h5>
                    <p class="card-text display-4">{{ $totalEquipamentosEmEmprestimo }}</p>
                </div>
            </div>
        </div>

        <!-- Cartão de Equipamentos Indisponíveis -->
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Equipamentos Indisponíveis</h5>
                    <p class="card-text display-4">{{ $totalEquipamentosIndisponiveis }}</p>
                </div>
            </div>
        </div>

        <!-- Cartão de Empréstimos Ativos -->
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Empréstimos Ativos</h5>
                    <p class="card-text display-4">{{ $totalEmprestimosAtivos }}</p>
                </div>
            </div>
        </div>

        <!-- Cartão de Usuários Cadastrados -->
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Usuários Cadastrados</h5>
                    <p class="card-text display-4">{{ $totalUsuarios }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de Gráficos -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center">Empréstimos Ativos</h5>
                    <canvas id="emprestimosChart" class="chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center">Equipamentos</h5>
                    <canvas id="equipamentosChart" class="chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center">Usuários</h5>
                    <canvas id="usuariosChart" class="chart"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Importando o Chart.js para os gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Definindo o mesmo tamanho para todos os gráficos
        var chartOptions = {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 1, // Define que o gráfico será quadrado
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    backgroundColor: '#000',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                }
            }
        };

        // Gráfico de Empréstimos
        var ctx1 = document.getElementById('emprestimosChart').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Ativos', 'Devolvidos'],
                datasets: [{
                    data: [{{ $totalEmprestimosAtivos }}, {{ $totalEmprestimosDevolvidos }}],
                    backgroundColor: ['#4caf50', '#2196f3'],
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: chartOptions
        });

        // Gráfico de Equipamentos
        var ctx2 = document.getElementById('equipamentosChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Disponíveis', 'Emprestados', 'Indisponíveis', 'Devolvidos'],
                datasets: [{
                    data: [{{ $totalEquipamentosDisponiveis }}, {{ $totalEquipamentosEmEmprestimo }}, {{ $totalEquipamentosIndisponiveis }}, {{ $totalEquipamentosDevolvidos }}],
                    backgroundColor: ['#4caf50', '#ff9800', '#f44336', '#2196f3'],
                    borderWidth: 2
                }]
            },
            options: chartOptions
        });

        // Gráfico de Usuários
        var ctx3 = document.getElementById('usuariosChart').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Total de Usuários'],
                datasets: [{
                    label: 'Usuários Cadastrados',
                    data: [{{ $totalUsuarios }}],
                    backgroundColor: '#2196f3',
                    borderColor: '#1976d2',
                    borderWidth: 2,
                    borderRadius: 5,
                }]
            },
            options: chartOptions
        });
    </script>
@endsection
