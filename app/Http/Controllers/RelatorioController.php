<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
use App\Models\Setor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        $dataInicio = $request->input('data_inicio') ? Carbon::parse($request->input('data_inicio')) : null;
        $dataFim = $request->input('data_fim') ? Carbon::parse($request->input('data_fim')) : null;

        // Query para obter os empréstimos no período selecionado
        $emprestimosQuery = Emprestimos::with('user', 'equipamento')
            ->when($dataInicio, fn($query) => $query->where('data_emprestimo', '>=', $dataInicio))
            ->when($dataFim, fn($query) => $query->where('data_emprestimo', '<=', $dataFim));

        $emprestimos = $emprestimosQuery->get();

        // Totais por status de equipamentos
        $totalEquipamentos = Equipamentos::count();
        $totalEquipamentosDisponiveis = Equipamentos::where('status', 'disponível')->count();
        $totalEquipamentosIndisponiveis = Equipamentos::where('status', 'indisponível')->count();

        $totalEquipamentosDevolvidos = Equipamentos::join('emprestimos', 'equipamentos.id', '=', 'emprestimos.equipamento_id')
            ->whereNotNull('emprestimos.data_devolucao')
            ->count();

        $totalEquipamentosEmManutencao = Equipamentos::join('manutencao', 'equipamentos.id', '=', 'manutencao.equipamento_id')
            ->where('manutencao.status', 'Em Manutenção')
            ->count();

        $totalEquipamentosManutencaoConcluida = Equipamentos::join('manutencao', 'equipamentos.id', '=', 'manutencao.equipamento_id')
            ->where('manutencao.status', 'Manutenção Concluida')
            ->count();

        // Contando os empréstimos ativos e devolvidos
        $totalEmprestimosAtivos = $emprestimos->whereNull('data_devolucao')->count();
        $totalEmprestimosDevolvidos = $emprestimos->whereNotNull('data_devolucao')->count();

        // Total de usuários
        $totalUsuarios = User::count();

        // Verificando se existem empréstimos
        $nenhumEmprestimo = $emprestimos->isEmpty();

        // Carregando setores com seus respectivos equipamentos
        $setores = Setor::with('equipamentos')->get();

        // Retornando os dados para a view
        return view('relatorio.index', compact(
            'dataInicio',
            'dataFim',
            'totalEquipamentos',
            'totalEquipamentosDisponiveis',
            'totalEquipamentosIndisponiveis',
            'totalEquipamentosDevolvidos',
            'totalEquipamentosEmManutencao',
            'totalEquipamentosManutencaoConcluida',
            'totalEmprestimosAtivos',
            'totalEmprestimosDevolvidos',
            'totalUsuarios',
            'nenhumEmprestimo',
            'emprestimos',
            'setores'
        ));
    }
}
