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
        // Carrega todos os equipamentos
        $equipamentos = Equipamentos::all(); 

        // Passa os equipamentos para a view
        return view('equipamentos.index', compact('equipamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Carrega equipamentos com suas categorias, setores e manutenções
        $equipamentos = Equipamentos::with(['categoria', 'setor', 'manutencoes'])->get();

        // Carrega todos os usuários
        $usuarios = User::all();

        // Retorna a view com os dados necessários
        return view('equipamentos.create', compact('equipamentos', 'usuarios'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $rules = [
            'nome' => 'required|string|max:255',
            'numero_serie' => 'required|string',
            'status' => 'required|string|in:disponível,emprestado,indisponível',
            'categoria_nome' => 'required|string',
            'setor_nome' => 'required|string',
        ];

        // Se o status for "emprestado", valida o usuário responsável
        if ($request->status === 'emprestado') {
            $rules['usuario_responsavel'] = 'required|exists:users,id';
        }

        // Aplica a validação
        $request->validate($rules);

        // Criação ou obtenção do Setor
        $setor = Setor::firstOrCreate([
            'nome' => $request->setor_nome
        ]);

        // Criação ou obtenção da Categoria
        $categoria = Categoria::firstOrCreate([
            'nome' => $request->categoria_nome
        ]);

        // Criação do Equipamento
        Equipamentos::create([
            'nome' => $request->nome,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,
            'categoria_id' => $categoria->id,
            'setor_id' => $setor->id,
            'usuario_responsavel' => $request->usuario_responsavel ?? null, // Salva o ID do responsável ou null
        ]);

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento cadastrado com sucesso!');
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
            'usuario_responsavel' => 'required_if:status,emprestado|string', // Agora é o nome, não o ID
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
            // Atualiza as informações de empréstimo, apenas se o status for 'emprestado'
            'usuario_responsavel' => $request->usuario_responsavel ?? null,
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
