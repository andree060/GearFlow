<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
use App\Models\Usuarios;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard com as informações gerais.
     */
    public function index()
    {
        // Pegando o número de empréstimos ativos e devolvidos
        $totalEmprestimosAtivos = Emprestimos::whereNull('data_devolucao_real')->count();
        $totalEmprestimosDevolvidos = Emprestimos::whereNotNull('data_devolucao_real')->count();

        // Pegando o número de equipamentos
        $totalEquipamentos = Equipamentos::count();
        $totalEquipamentosDisponiveis = Equipamentos::where('status', 'disponível')->count();

        // Pegando o número de usuários
        $totalUsuarios = Usuarios::count();

        // Passando essas informações para a view
        return view('dashboard.index', compact(
            'totalEmprestimosAtivos',
            'totalEmprestimosDevolvidos',
            'totalEquipamentos',
            'totalEquipamentosDisponiveis',
            'totalUsuarios'
        ));
    }
}
