<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
use App\Models\Categoria;
use App\Models\Setor;
use App\Models\User;
use Illuminate\Http\Request;

class EmprestimosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pegando todos os empréstimos e verificando se o status precisa ser alterado
        $emprestimos = Emprestimos::with(['equipamento', 'user'])->get(); // Relacionando o equipamento e o usuário
        return view('emprestimos.index', compact('emprestimos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pegando todos os equipamentos e usuários
        $equipamentos = Equipamentos::where('status', 'disponível')->get();  // Aqui você pega todos os equipamentos disponíveis
        $usuarios = User::all();  // Aqui você pega todos os usuários
        return view('emprestimos.create', compact('equipamentos', 'usuarios'));  // Passando para a view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',  // Verifica se o equipamento existe
            'user_id' => 'required|exists:users,id',  // Verifica se o usuário existe
            'data_emprestimo' => 'required|date',
            'data_devolucao_prevista' => 'required|date|after:data_emprestimo',
            'setor_nome' => 'required|string|max:255', // Adicionar validação para o nome do setor
        ]);

        // Verificar se o equipamento já está emprestado
        $equipamentoId = $request->input('equipamento_id');
        $equipamentoEmprestado = Equipamentos::find($equipamentoId);

        if ($equipamentoEmprestado->status == 'indisponível') {
            return redirect()->back()->with('error', 'Este equipamento já está emprestado para outro usuário.');
        }

        // Verificar se o setor existe ou criar um novo
        $setor = Setor::firstOrCreate([
            'nome' => $request->input('setor_nome') // Cria ou encontra o setor com o nome fornecido
        ]);

        // Lógica para criar o empréstimo
        $emprestimo = Emprestimos::create([
            'equipamento_id' => $request->input('equipamento_id'),
            'user_id' => $request->input('user_id'),
            'data_emprestimo' => $request->input('data_emprestimo'),
            'data_devolucao_prevista' => $request->input('data_devolucao_prevista'),
        ]);

        // Atualizando o status do equipamento para 'indisponível'
        $equipamentoEmprestado->status = 'indisponível';
        $equipamentoEmprestado->save(); // Salva o status atualizado

        // Redireciona para a lista de empréstimos com sucesso
        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo cadastrado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emprestimo = Emprestimos::with(['equipamento', 'user'])->findOrFail($id); // Relacionando equipamento e usuário
        return view('emprestimos.show', compact('emprestimo')); // Passar dados para a view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emprestimo = Emprestimos::findOrFail($id); // Encontrar o empréstimo pelo ID ou retornar erro 404
        $equipamentos = Equipamentos::all(); // Obter todos os equipamentos
        $usuarios = User::all(); // Obter todos os usuários
        return view('emprestimos.edit', compact('emprestimo', 'equipamentos', 'usuarios')); // Passar dados para a view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $emprestimo = Emprestimos::findOrFail($id); // Encontrar o empréstimo

        // Se o botão "Devolver" foi pressionado
        if ($request->devolver == 'true') {
            $equipamento = Equipamentos::find($emprestimo->equipamento_id); // Recupera o equipamento relacionado ao empréstimo
            $equipamento->status = 'disponível'; // Atualiza o status para 'disponível'
            $equipamento->save(); // Salva a alteração no equipamento

            // Define a data de devolução como a data atual
            $emprestimo->data_devolucao = now(); // A função 'now()' irá pegar a data e hora atuais.
            $emprestimo->save(); // Salva a alteração no empréstimo

            return redirect()->route('emprestimos.index')->with('success', 'Equipamento devolvido com sucesso!');
        }

        // Caso contrário, atualiza normalmente os dados do empréstimo
        $emprestimo->update($request->all());

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $emprestimo = Emprestimos::findOrFail($id);

        // Verifica se o equipamento está emprestado
        $equipamento = Equipamentos::find($emprestimo->equipamento_id);
        if ($equipamento) {
            // Se o empréstimo for deletado, muda o status do equipamento de volta para 'disponível'
            $equipamento->status = 'disponível';
            $equipamento->save();
        }

        $emprestimo->delete();

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo removido com sucesso!');
    }
}
