<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
use App\Models\Manutencao;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalEquipamentos = Equipamentos::count();
        $totalUsuarios = User::count();
        $totalEmprestimos = Emprestimos::count();
        $totalEmprestimosAtivos = Emprestimos::whereNull('data_devolucao_real')->count();
        $totalManutencoesAtivas = Manutencao::where('status', '!=', 'Manutenção Concluida')->count();

        return view('home.index', compact(
            'totalEquipamentos',
            'totalUsuarios',
            'totalEmprestimos',
            'totalEmprestimosAtivos',
            'totalManutencoesAtivas'
        ));
    }
}
