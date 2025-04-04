<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class EmprestimosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprestimos = Emprestimos::all();
        return view('emprestimos.index', compact('emprestimos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pegando todos os equipamentos e usuários
        $equipamentos = Equipamentos::all();  // Aqui você pega todos os equipamentos
        $usuarios = Usuarios::all();  // Aqui você pega todos os usuários
        return view('emprestimos.create', compact('equipamentos', 'usuarios'));  // Passando para a view
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao_prevista' => 'required|date|after:data_emprestimo',
        ]);

        // Criação do empréstimo
        Emprestimos::create([
            'equipamento_id' => $request->equipamento_id,
            'usuario_id' => $request->usuario_id,
            'data_emprestimo' => $request->data_emprestimo,
            'data_devolucao_prevista' => $request->data_devolucao_prevista,
            'status' => 'ativo'
        ]);

        return redirect()->route('emprestimos.index');
    }

    /**
     * Display the specified resource.
     */
        public function show($id)
    {
        $emprestimo = Emprestimos::findOrFail($id); // Encontrar o empréstimo pelo ID
        return view('emprestimos.show', compact('emprestimo')); // Passar dados para a view
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit($id)
    {
        $emprestimo = Emprestimos::findOrFail($id); // Encontrar o empréstimo pelo ID ou retornar erro 404
        $equipamentos = Equipamentos::all(); // Obter todos os equipamentos
        $usuarios = Usuarios::all(); // Obter todos os usuários
        return view('emprestimos.edit', compact('emprestimo', 'equipamentos', 'usuarios')); // Passar dados para a view
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados do empréstimo
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao_prevista' => 'required|date|after:data_emprestimo',
        ]);

        // Encontrar o empréstimo pelo ID
        $emprestimo = Emprestimos::findOrFail($id);
        $emprestimo->update([
            'equipamento_id' => $request->equipamento_id,
            'usuario_id' => $request->usuario_id,
            'data_emprestimo' => $request->data_emprestimo,
            'data_devolucao_prevista' => $request->data_devolucao_prevista,
        ]);

        // Redireciona para a página de detalhes do empréstimo
        return redirect()->route('emprestimos.show', $emprestimo->id)
                     ->with('success', 'Empréstimo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $emprestimo = Emprestimos::findOrFail($id);
        $emprestimo->delete();

        return redirect()->route('emprestimos.index');
    }
}
