<?php

namespace App\Http\Controllers;

use App\Models\Manutencao;
use App\Models\Equipamentos;
use Illuminate\Http\Request;

class ManutencaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carrega todas as manutenções
        $manutencao = Manutencao::all();
        return view('manutencao.index', compact('manutencao'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Carrega todos os equipamentos
        $equipamentos = Equipamentos::all();
        return view('manutencao.create', compact('equipamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'data_manutencao' => 'required|date',
            'descricao' => 'required|string',
            'responsavel' => 'required|string',
            'status' => 'required|string',
            'custo' => 'nullable|numeric',
            'proxima_manutencao' => 'nullable|date',
        ]);

        // Verifica o status do equipamento
        $equipamento = Equipamentos::findOrFail($request->equipamento_id);

        if ($equipamento->status === 'emprestado') {
            return redirect()->back()->withErrors('O equipamento está emprestado. A manutenção só pode ser iniciada após o término do empréstimo.');
        }

        // Criação da manutenção
        $manutencao = new Manutencao;
        $manutencao->equipamento_id = $request->equipamento_id;
        $manutencao->data_manutencao = $request->data_manutencao;
        $manutencao->descricao = $request->descricao;
        $manutencao->responsavel = $request->responsavel;
        $manutencao->status = $request->status;
        $manutencao->custo = $request->custo ?? null;
        $manutencao->proxima_manutencao = $request->proxima_manutencao ?? null;

        // Atualiza o status do equipamento com base no status da manutenção
        if ($request->status === 'Manutenção Concluida') {
            $equipamento->status = 'disponível';
        } elseif ($request->data_manutencao <= date('Y-m-d')) {
            $equipamento->status = 'indisponível';
        }
        $equipamento->save();

        // Salva a manutenção no banco de dados
        $manutencao->save();

        return redirect()->route('manutencao.index')->with('success', 'Manutenção registrada com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Encontra a manutenção pelo id
        $manutencao = Manutencao::findOrFail($id);
        return view('manutencao.show', compact('manutencao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $manutencao = Manutencao::findOrFail($id);  // Encontra a manutenção pelo id
        $equipamentos = Equipamentos::all();  // Carrega todos os equipamentos
        return view('manutencao.edit', compact('manutencao', 'equipamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'data_manutencao' => 'required|date',
            'descricao' => 'required|string',
            'responsavel' => 'required|string',
            'status' => 'required|string',
        ]);

        // Encontra a manutenção pelo id
        $manutencao = Manutencao::findOrFail($id);
        $equipamento = Equipamentos::findOrFail($request->equipamento_id);

        // Atualiza a manutenção com os novos dados
        $manutencao->update([
            'equipamento_id' => $request->equipamento_id,
            'data_manutencao' => $request->data_manutencao,
            'descricao' => $request->descricao,
            'responsavel' => $request->responsavel,
            'status' => $request->status,
            'custo' => $request->custo ?? null,
            'proxima_manutencao' => $request->proxima_manutencao ?? null,
        ]);

        // Atualiza o status do equipamento com base no status da manutenção
        if ($request->status === 'Manutenção Concluida') {
            $equipamento->status = 'disponível';
        } elseif ($request->status === 'Em Manutenção' && $request->data_manutencao <= date('Y-m-d')) {
            $equipamento->status = 'indisponível';
        }
        $equipamento->save();

        return redirect()->route('manutencao.index')->with('success', 'Manutenção atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $manutencao = Manutencao::findOrFail($id);
        $manutencao->delete();

        return redirect()->route('manutencao.index')->with('success', 'Manutenção excluída com sucesso!');
    }
}