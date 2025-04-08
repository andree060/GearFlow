@extends('layouts.app')

@section('title', 'Relatórios - Sistema de Empréstimos')

@section('content')

    <!-- Cabeçalho de Relatório -->
    <h1 class="text-center mb-4 font-weight-bold" style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
        Relatórios de Empréstimos e Equipamentos
    </h1>

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

        <!-- Cartão de Equipamentos em Empréstimo -->
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Equipamentos Emprestado</h5>
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

        <!-- Cartão de Empréstimos Expirados -->
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Empréstimos Expirados</h5>
                    <p class="card-text display-4">{{ $totalEmprestimosExpirados }}</p>
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
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center">Empréstimos</h5>
                    <canvas id="emprestimosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center">Equipamentos</h5>
                    <canvas id="equipamentosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center">Usuários</h5>
                    <canvas id="usuariosChart"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Importando o Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dados do gráfico de empréstimos
            const emprestimosData = {
                labels: ['Ativos', 'Expirados'],
                datasets: [{
                    label: 'Empréstimos',
                    data: [{{ $totalEmprestimosAtivos }}, {{ $totalEmprestimosExpirados }}],
                    backgroundColor: ['#007bff', '#dc3545'],
                    borderColor: ['#0056b3', '#c82333'],
                    borderWidth: 1
                }]
            };

            // Dados do gráfico de equipamentos
            const equipamentosData = {
                labels: ['Disponíveis', 'Em Empréstimo', 'Indisponíveis'],
                datasets: [{
                    label: 'Equipamentos',
                    data: [{{ $totalEquipamentosDisponiveis }}, {{ $totalEquipamentosEmEmprestimo }}, {{ $totalEquipamentosIndisponiveis }}],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderColor: ['#218838', '#e0a800', '#c82333'],
                    borderWidth: 1
                }]
            };

            // Dados do gráfico de usuários
            const usuariosData = {
                labels: ['Cadastrados'],
                datasets: [{
                    label: 'Usuários',
                    data: [{{ $totalUsuarios }}],
                    backgroundColor: ['#007bff'],
                    borderColor: ['#0056b3'],
                    borderWidth: 1
                }]
            };

            // Opções comuns para os gráficos
            const options = {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            };

            // Criando os gráficos
            new Chart(document.getElementById('emprestimosChart'), {
                type: 'bar',
                data: emprestimosData,
                options: options
            });

            new Chart(document.getElementById('equipamentosChart'), {
                type: 'bar',
                data: equipamentosData,
                options: options
            });

            new Chart(document.getElementById('usuariosChart'), {
                type: 'bar',
                data: usuariosData,
                options: options
            });
        });
    </script>
@endsection
