<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Pegando os dados para a tela inicial
        $totalEquipamentos = Equipamentos::count();
        $totalUsuarios = User::count();
        $totalEmprestimos = Emprestimos::count();
        $totalEmprestimosAtivos = Emprestimos::whereNull('data_devolucao_real')->count();

        // Passando para a view
        return view('home.index', compact(
            'totalEquipamentos',
            'totalUsuarios',
            'totalEmprestimos',
            'totalEmprestimosAtivos'
        ));
    }
}
