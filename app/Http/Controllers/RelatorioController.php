<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    /**
     * Exibe o relatório com as informações gerais.
     */
    public function index(Request $request)
    {
        // Obtendo as datas de filtro, caso existam
        $dataInicio = $request->input('data_inicio') ? Carbon::parse($request->input('data_inicio')) : null;
        $dataFim = $request->input('data_fim') ? Carbon::parse($request->input('data_fim')) : null;
    
        // Consultando os dados do banco com base nas datas
        $equipamentos = Equipamentos::all();
        $emprestimosQuery = Emprestimos::with('user', 'equipamento')
            ->when($dataInicio, function ($query) use ($dataInicio) {
                return $query->where('data_emprestimo', '>=', $dataInicio);
            })
            ->when($dataFim, function ($query) use ($dataFim) {
                return $query->where('data_emprestimo', '<=', $dataFim);
            });
    
        $emprestimos = $emprestimosQuery->get();
    
        // Contagem dos dados de equipamentos diretamente no banco
        $totalEquipamentos = Equipamentos::count();
        $totalEquipamentosDisponiveis = Equipamentos::where('status', 'disponível')->count();
        $totalEquipamentosEmEmprestimo = Equipamentos::where('status', 'emprestado')->count();
        $totalEquipamentosIndisponiveis = Equipamentos::where('status', 'indisponível')->count();
        $totalEquipamentosDevolvidos = Equipamentos::where('status', 'devolvido')->count();
    
        // Contagem dos dados de empréstimos
        $totalEmprestimosAtivos = $emprestimos->whereNull('data_devolucao')->count(); // Considerando que um empréstimo sem data de devolução está ativo
        $totalEmprestimosDevolvidos = $emprestimos->whereNotNull('data_devolucao')->count(); // Considerando que um empréstimo com data de devolução está devolvido
    
        // Contagem de usuários cadastrados
        $totalUsuarios = User::count();
    
        // Variável para verificar se não existem empréstimos para o período
        $nenhumEmprestimo = $emprestimos->isEmpty();
    
        // Retornando para a visão com as variáveis
        return view('relatorio.index', compact(
            'dataInicio',
            'dataFim',
            'totalEquipamentos',
            'totalEquipamentosDisponiveis',
            'totalEquipamentosEmEmprestimo',
            'totalEquipamentosIndisponiveis',
            'totalEquipamentosDevolvidos',
            'totalEmprestimosAtivos',
            'totalEmprestimosDevolvidos',
            'totalUsuarios',
            'nenhumEmprestimo',
            'emprestimos'
        ));
    }
    
}
