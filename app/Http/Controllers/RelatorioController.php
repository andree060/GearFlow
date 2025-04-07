<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
use App\Models\User;

class RelatorioController extends Controller
{
    /**
     * Exibe o relatorio com as informações gerais.
     */
    public function index()
    {
        // Pegando o número de empréstimos ativos e expirados
        $totalEmprestimosAtivos = Emprestimos::whereNull('data_devolucao_real')
            ->where('data_devolucao_prevista', '>=', now())  // Empréstimos ainda não devolvidos e dentro do prazo
            ->count();

        $totalEmprestimosExpirados = Emprestimos::whereNull('data_devolucao_real')
            ->where('data_devolucao_prevista', '<', now())  // Empréstimos ainda não devolvidos e fora do prazo
            ->count();

        // Pegando o número de equipamentos
        $totalEquipamentos = Equipamentos::count();
        $totalEquipamentosDisponiveis = Equipamentos::where('status', 'disponível')->count();
        $totalEquipamentosEmEmprestimo = Equipamentos::where('status', 'em empréstimo')->count();
        $totalEquipamentosIndisponiveis = Equipamentos::where('status', 'indisponível')->count();

        // Pegando o número de usuários
        $totalUsuarios = User::count();

        // Passando essas informações para a view
        return view('relatorio.index', compact(
            'totalEmprestimosAtivos',
            'totalEmprestimosExpirados',
            'totalEquipamentos',
            'totalEquipamentosDisponiveis',
            'totalEquipamentosEmEmprestimo',
            'totalEquipamentosIndisponiveis',
            'totalUsuarios'
        ));
    }
}

