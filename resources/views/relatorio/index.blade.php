@extends('layouts.app')

@section('title', 'Relatórios - Sistema de Empréstimos')

@section('content')
    <h1 class="text-center mb-4 font-weight-bold animated fadeIn" style="font-size: 3rem; color: #343a40;">
        Relatórios de Equipamentos e Empréstimos
    </h1>

    <form method="GET" action="{{ route('relatorio.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="data_inicio">Data Início:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control shadow-sm" value="{{ $dataInicio ? $dataInicio->format('Y-m-d') : '' }}">
            </div>
            <div class="col-md-3">
                <label for="data_fim">Data Fim:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control shadow-sm" value="{{ $dataFim ? $dataFim->format('Y-m-d') : '' }}">
            </div>
            <div class="col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control shadow-sm">Filtrar</button>
            </div>
        </div>
    </form>

    @if ($dataInicio && $dataFim)
        <div class="alert alert-info text-center mb-4 shadow-sm animated fadeIn">
            <strong>Período Selecionado:</strong> {{ $dataInicio->format('d/m/Y') }} até {{ $dataFim->format('d/m/Y') }}
        </div>
    @elseif ($dataInicio)
        <div class="alert alert-info text-center mb-4 shadow-sm animated fadeIn">
            <strong>Data de Início:</strong> {{ $dataInicio->format('d/m/Y') }}
        </div>
    @elseif ($dataFim)
        <div class="alert alert-info text-center mb-4 shadow-sm animated fadeIn">
            <strong>Data de Fim:</strong> {{ $dataFim->format('d/m/Y') }}
        </div>
    @endif

    @if ($dataInicio || $dataFim)
        @if ($emprestimos->count() > 0)
            <table class="table table-hover table-striped table-bordered shadow-sm animated fadeInUp">
                <thead class="thead-dark">
                    <tr>
                        <th>Data de Empréstimo</th>
                        <th>Usuário</th>
                        <th>Equipamento</th>
                        <th>Status do Equipamento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emprestimos as $emprestimo)
                        <tr>
                            <td class="text-center">{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                            <td>{{ $emprestimo->user->name }}</td>
                            <td>{{ $emprestimo->equipamento->nome ?? 'Equipamento não atribuído' }}</td>
                            <td class="text-center">
                                @php $status = $emprestimo->equipamento->status ?? 'indisponível'; @endphp
                                <span class="badge
                                    @if ($status == 'disponível') bg-success
                                    @elseif ($status == 'indisponível') bg-danger
                                    @elseif ($status == 'devolvido') bg-info
                                    @elseif ($status == 'em manutenção') bg-secondary
                                    @elseif ($status == 'Manutenção Concluida') bg-primary
                                    @else bg-dark
                                    @endif
                                ">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning text-center shadow-sm animated fadeIn">
                Nenhum empréstimo encontrado para o período selecionado.
            </div>
        @endif
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4 animated fadeInUp">
        @foreach ([
            ['title' => 'Equipamentos Totais', 'value' => $totalEquipamentos],
            ['title' => 'Equipamentos Disponíveis', 'value' => $totalEquipamentosDisponiveis],
            ['title' => 'Equipamentos Indisponíveis', 'value' => $totalEquipamentosIndisponiveis],
            ['title' => 'Equipamentos Emprestado|Devolvidos', 'value' => $totalEquipamentosDevolvidos],
            ['title' => 'Equipamentos em Manutenção', 'value' => $totalEquipamentosEmManutencao],
            ['title' => 'Equipamentos em Manutenção Concluida', 'value' => $totalEquipamentosManutencaoConcluida],
            ['title' => 'Empréstimos Ativos', 'value' => $totalEmprestimosAtivos],
            ['title' => 'Usuários Cadastrados', 'value' => $totalUsuarios],
        ] as $card)
            <div class="col">
                <div class="card h-100 shadow-lg rounded-3 animated zoomIn" style="animation-delay: {{ $loop->iteration * 0.3 }}s;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">{{ $card['title'] }}</h5>
                        <p class="card-text display-4 text-primary">{{ $card['value'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row d-flex justify-content-between g-4 animated fadeInUp">
        <div class="col-md-4">
            <div class="card shadow-lg rounded-3">
                <div class="card-body">
                    <h5 class="text-center">Empréstimos Ativos</h5>
                    <canvas id="emprestimosChart" class="chart" style="height: 350px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg rounded-3">
                <div class="card-body">
                    <h5 class="text-center">Equipamentos</h5>
                    <canvas id="equipamentosChart" class="chart" style="height: 350px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg rounded-3">
                <div class="card-body">
                    <h5 class="text-center">Usuários</h5>
                    <canvas id="usuariosChart" class="chart" style="height: 350px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="text-center mb-4">Setores e Equipamentos Relacionados</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($setores as $setor)
                <div class="col mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">{{ $setor->nome }}</h5>
                        </div>
                        <div class="card-body">
                            @if($setor->equipamentos->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($setor->equipamentos as $equipamento)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $equipamento->nome }}
                                            <span class="badge
                                                @if($equipamento->status == 'disponível') bg-success

                                                @elseif($equipamento->status == 'indisponível') bg-danger
                                                @elseif($equipamento->status == 'em manutenção') bg-secondary
                                                @elseif($equipamento->status == 'Manutenção Concluida') bg-info
                                                @elseif($equipamento->status == 'devolvido') bg-primary
                                                @else bg-danger
                                                @endif
                                            ">
                                                {{ ucfirst($equipamento->status) }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Nenhum equipamento cadastrado neste setor.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 1,
        animation: {
            duration: 1000,
            easing: 'easeOutBounce'
        },
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                backgroundColor: '#000',
                titleColor: '#fff',
                bodyColor: '#fff',
                bodyFont: { size: 14 }
            }
        }
    };

    new Chart(document.getElementById('emprestimosChart'), {
        type: 'doughnut',
        data: {
            labels: ['Ativos', 'Devolvidos'],
            datasets: [{
                data: [{{ $totalEmprestimosAtivos }}, {{ $totalEmprestimosDevolvidos }}],
                backgroundColor: ['#4caf50', '#2196f3'],
                borderWidth: 4,
                hoverOffset: 20
            }]
        },
        options: chartOptions
    });

    new Chart(document.getElementById('equipamentosChart'), {
        type: 'pie',
        data: {
            labels: ['Disponíveis', 'Indisponíveis', 'Devolvidos', 'Em Manutenção', 'Em Manutenção Concluida'],
            datasets: [{
                data: [
                    {{ $totalEquipamentosDisponiveis }},
                    {{ $totalEquipamentosIndisponiveis }},
                    {{ $totalEquipamentosIndisponiveis }},
                    {{ $totalEquipamentosDevolvidos }},
                    {{ $totalEquipamentosEmManutencao }},
                    {{ $totalEquipamentosManutencaoConcluida }}
                ],
                backgroundColor: ['#4caf50', '#f44336', '#2196f3', '#ff9800', '#9e9e9e', '#00bcd4'],
                borderWidth: 4
            }]
        },
        options: chartOptions
    });

    new Chart(document.getElementById('usuariosChart'), {
        type: 'bar',
        data: {
            labels: ['Total de Usuários'],
            datasets: [{
                label: 'Usuários Cadastrados',
                data: [{{ $totalUsuarios }}],
                backgroundColor: '#2196f3',
                borderWidth: 4
            }]
        },
        options: chartOptions
    });
</script>
@endsection
