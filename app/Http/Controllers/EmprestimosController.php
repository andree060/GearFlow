<?php

namespace App\Http\Controllers;

use App\Models\Emprestimos;
use App\Models\Equipamentos;
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
        $emprestimos = Emprestimos::all()->map(function ($emprestimo) {

            return $emprestimo;
        });

        return view('emprestimos.index', compact('emprestimos'));
    }

    // O resto do controlador permanece o mesmo...


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pegando todos os equipamentos e usuários
        $equipamentos = Equipamentos::all();  // Aqui você pega todos os equipamentos
        $usuarios = User::all();  // Aqui você pega todos os usuários
        return view('emprestimos.create', compact('equipamentos', 'usuarios'));  // Passando para a view
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Verificar se o equipamento já está emprestado
        $equipamentoId = $request->input('equipamento_id');
        $equipamentoEmprestado = Equipamentos::find($equipamentoId);
        // Se o equipamento estiver emprestado, retorna um erro
        if ($equipamentoEmprestado->status == 'Indisponível') {
            return redirect()->back()->with('error', 'Este equipamento já está emprestado para outro usuário.');
        }

        // Lógica para criar o empréstimo
        $emprestimo = new Emprestimos();
        $emprestimo->equipamento_id = $request->input('equipamento_id');
        $emprestimo->user_id = $request->input('user_id');
        $emprestimo->data_emprestimo = $request->input('data_emprestimo');
        $emprestimo->data_devolucao_prevista = $request->input('data_devolucao_prevista');
        $emprestimo->save();

        $equipamento_id = $emprestimo->equipamento_id;

        $equipamento = Equipamentos::find($equipamento_id);
        $equipamento->status = 'Indisponível';
        $equipamento->update();


        // Redireciona para a lista de empréstimos com sucesso
        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo cadastrado com sucesso!');
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
        $usuarios = User::all(); // Obter todos os usuários
        return view('emprestimos.edit', compact('emprestimo', 'equipamentos', 'usuarios')); // Passar dados para a view
    }

    public function update(Request $request, $id)
    {
        // Encontre o empréstimo
        $emprestimo = Emprestimos::findOrFail($id);

        $equipamento_id = $emprestimo->equipamento_id;

        $equipamento = Equipamentos::find($equipamento_id);

        // Verifica se o botão "Devolver" foi pressionado
        if ($request->devolver == 'true') {
            // Atualiza o status para "devolvido"
            $equipamento->status = 'disponível';
            $equipamento->update();

            // Define a data de devolução como a data atual
            $emprestimo->data_devolucao = now(); // A função 'now()' irá pegar a data e hora atuais.
            // Salva a alteração
            $emprestimo->save();

            // Redireciona com uma mensagem de sucesso
            return redirect()->route('emprestimos.index')->with('success', 'Equipamento devolvido com sucesso!');
        }

        // Se não for para devolver, apenas realiza a atualização normal
        // Isso pode ser útil para outros tipos de atualização
        $emprestimo->update($request->all());

        return redirect()->route('emprestimos.index');
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
