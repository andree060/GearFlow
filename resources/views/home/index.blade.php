@extends('layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
        <!-- Cartão de Equipamentos Totais -->
        <div class="col">
            <div class="card animated-card">
                <div class="card-body text-center">
                    <i class="fas fa-cogs icon-card"></i>
                    <h5 class="card-title text-muted">Equipamentos Totais</h5>
                    <p class="card-text fs-1 fw-bold text-dark">{{ $totalEquipamentos }}</p>
                </div>
            </div>
        </div>

        <!-- Cartão de Usuários Cadastrados -->
        <div class="col">
            <div class="card animated-card">
                <div class="card-body text-center">
                    <i class="fas fa-users icon-card"></i>
                    <h5 class="card-title text-muted">Usuários Cadastrados</h5>
                    <p class="card-text fs-1 fw-bold text-dark">{{ $totalUsuarios }}</p>
                </div>
            </div>
        </div>

        <!-- Cartão de Empréstimos Totais -->
        <div class="col">
            <div class="card animated-card">
                <div class="card-body text-center">
                    <i class="fas fa-hand-holding-usd icon-card"></i>
                    <h5 class="card-title text-muted">Empréstimos Totais</h5>
                    <p class="card-text fs-1 fw-bold text-dark">{{ $totalEmprestimos }}</p>
                </div>
            </div>
        </div>

        <!-- Cartão de Empréstimos Ativos -->
        <div class="col">
            <div class="card animated-card">
                <div class="card-body text-center">
                    <i class="fas fa-sync-alt icon-card"></i>
                    <h5 class="card-title text-muted">Empréstimos Ativos</h5>
                    <p class="card-text fs-1 fw-bold text-dark">{{ $totalEmprestimosAtivos }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
