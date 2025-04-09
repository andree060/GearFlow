<?php

namespace App\Http\Controllers;

use App\Models\Equipamentos;
use App\Models\Categoria;  // Adicionado
use App\Models\Setor;      // Adicionado
use App\Models\User;       // Adicionado para acessar os usuários
use Illuminate\Http\Request;

class EquipamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipamentos = Equipamentos::all(); // Carrega todos os equipamentos
        return view('equipamentos.index', compact('equipamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Carregar todos os usuários
        $usuarios = User::all();

        return view('equipamentos.create', compact('usuarios')); // Passa os usuários para a view de criação
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero_serie' => 'required|string',
            'status' => 'required|string|in:disponível,emprestado,indisponível', // Verifique se o status é válido
            'categoria_nome' => 'required|string',  // Valida o nome da categoria
            'setor_nome' => 'required|string',      // Valida o nome do setor
            // Validação sempre obrigatória para "data_emprestimo" e "data_devolucao_prevista"
            'data_emprestimo' => 'required|date',  // Tornado obrigatório sempre
            'usuario_responsavel' => 'required|exists:users,id',  // Verifica se o ID do usuário existe
            'data_devolucao_prevista' => 'required|date', // Tornado obrigatório sempre
        ]);

        // Criação ou obtenção do Setor
        $setor = Setor::firstOrCreate([
            'nome' => $request->setor_nome
        ]);

        // Criação ou obtenção da Categoria
        $categoria = Categoria::firstOrCreate([
            'nome' => $request->categoria_nome
        ]);

        // Criação do equipamento com as chaves estrangeiras de categoria e setor
        $equipamento = Equipamentos::create([
            'nome' => $request->nome,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,
            'categoria_id' => $categoria->id,  // Relaciona a categoria
            'setor_id' => $setor->id,          // Relaciona o setor
            // Salva as informações de empréstimo
            'data_emprestimo' => $request->data_emprestimo,
            'usuario_responsavel' => $request->usuario_responsavel,
            'data_devolucao_prevista' => $request->data_devolucao_prevista,
        ]);

        // Redireciona para a lista de equipamentos com uma mensagem de sucesso
        return redirect()->route('equipamentos.index')->with('success', 'Equipamento cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $equipamento = Equipamentos::find($id); // Carrega o equipamento
        return view('equipamentos.show', compact('equipamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipamento = Equipamentos::findOrFail($id); // Encontra o equipamento ou retorna erro 404
        // Carregar todos os usuários
        $usuarios = User::all();

        return view('equipamentos.edit', compact('equipamento', 'usuarios')); // Passa o equipamento e os usuários para a view de edição
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero_serie' => 'required|string|max:100',
            'status' => 'required|string|in:disponível,emprestado,indisponível', // Verifique os status válidos
            'categoria_nome' => 'required|string',  // Valida o nome da categoria
            'setor_nome' => 'required|string',      // Valida o nome do setor
            // Validação sempre obrigatória para "data_emprestimo" e "data_devolucao_prevista"
            'data_emprestimo' => 'required|date',  // Tornado obrigatório sempre
            'usuario_responsavel' => 'required|exists:users,id',  // Verifica se o ID do usuário existe
            'data_devolucao_prevista' => 'required|date', // Tornado obrigatório sempre
        ]);

        // Atualiza o equipamento
        $equipamento = Equipamentos::findOrFail($id);

        // Criação ou obtenção do Setor
        $setor = Setor::firstOrCreate([
            'nome' => $request->setor_nome
        ]);

        // Criação ou obtenção da Categoria
        $categoria = Categoria::firstOrCreate([
            'nome' => $request->categoria_nome
        ]);

        // Atualiza os dados do equipamento com as novas informações de categoria e setor
        $equipamento->update([
            'nome' => $request->nome,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,  // Atualiza o status conforme o valor enviado
            'categoria_id' => $categoria->id,  // Atualiza a categoria
            'setor_id' => $setor->id,          // Atualiza o setor
            // Atualiza as informações de empréstimo
            'data_emprestimo' => $request->data_emprestimo,
            'usuario_responsavel' => $request->usuario_responsavel,
            'data_devolucao_prevista' => $request->data_devolucao_prevista,
        ]);

        // Redireciona para a página de detalhes do equipamento com uma mensagem de sucesso
        return redirect()->route('equipamentos.show', $equipamento->id)
                         ->with('success', 'Equipamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipamento = Equipamentos::find($id);
        $equipamento->delete();

        return redirect()->route('equipamentos.index');
    }
}
