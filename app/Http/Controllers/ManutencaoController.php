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
            'status' => 'required|string',  // Validar o status (Em Manutenção ou Funcionando)
            'custo' => 'nullable|numeric',  // Custo opcional
            'proxima_manutencao' => 'nullable|date',  // Data opcional
        ]);

        // Criação da manutenção
        $manutencao = new Manutencao;
        $manutencao->equipamento_id = $request->equipamento_id;
        $manutencao->data_manutencao = $request->data_manutencao;
        $manutencao->descricao = $request->descricao;
        $manutencao->responsavel = $request->responsavel;
        $manutencao->status = $request->status;  // Usando o status escolhido pelo usuário
        $manutencao->custo = $request->custo ?? null;  // Se custo não for fornecido, será null
        $manutencao->proxima_manutencao = $request->proxima_manutencao ?? null;  // Se próxima manutenção não for fornecida, será null

        // Salva a manutenção no banco de dados
        $manutencao->save();

        // Redireciona com uma mensagem de sucesso
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
            'status' => 'required|string', // Validar o status como string
        ]);

        // Encontra a manutenção pelo id
        $manutencao = Manutencao::findOrFail($id);

        // Atualiza a manutenção com os novos dados
        $manutencao->update([
            'equipamento_id' => $request->equipamento_id,
            'data_manutencao' => $request->data_manutencao,
            'descricao' => $request->descricao,
            'responsavel' => $request->responsavel,
            'status' => $request->status,  // O status será alterado para o valor selecionado no formulário
            'custo' => $request->custo ?? null,  // Se o custo não for alterado, mantém o valor atual
            'proxima_manutencao' => $request->proxima_manutencao ?? null, // Se a data da próxima manutenção não for fornecida, será null
        ]);

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
