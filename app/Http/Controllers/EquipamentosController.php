<?php

namespace App\Http\Controllers;

use App\Models\Equipamentos;
use App\Models\Categoria;  // Adicionado
use App\Models\Setor;      // Adicionado
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
        // Carregar categorias e setores existentes
        $categorias = Categoria::all();  // Se você tem uma tabela 'categorias'
        $setores = Setor::all();  // Se você tem uma tabela 'setores'

        // Retornar a view passando as categorias e setores
        return view('equipamentos.create', compact('categorias', 'setores'));
    }

    public function store(Request $request)
    {
        // Validar os dados recebidos
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero_serie' => 'required|string|max:255',
            'status' => 'required|string',
            'categoria_nome' => 'nullable|string|max:255', // Nova categoria
            'setor_nome' => 'nullable|string|max:255', // Novo setor
            'categoria_id' => 'nullable|exists:categorias,id', // Categoria existente
            'setor_id' => 'nullable|exists:setores,id', // Setor existente
        ]);

        // Verificar se uma nova categoria foi informada e se sim, criar
        if ($request->filled('categoria_nome')) {
            $categoria = Categoria::create(['nome' => $request->categoria_nome]);
        } else {
            $categoria = Categoria::find($request->categoria_id);
        }

        // Verificar se um novo setor foi informado e se sim, criar
        if ($request->filled('setor_nome')) {
            $setor = Setor::create(['nome' => $request->setor_nome]);
        } else {
            $setor = Setor::find($request->setor_id);
        }

        // Criar o equipamento
        $equipamento = new Equipamentos([
            'nome' => $request->nome,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,
            'categoria_id' => $categoria->id,
            'setor_id' => $setor->id,
        ]);

        $equipamento->save();

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento cadastrado com sucesso!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        // Encontra o equipamento ou retorna erro 404
        $equipamento = Equipamentos::with(['categoria', 'setor'])->findOrFail($id);

        // Retorna a view de detalhes do equipamento
        return view('equipamentos.show', compact('equipamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipamento = Equipamentos::findOrFail($id); // Encontra o equipamento ou retorna erro 404
        // Carregar todos os setores
        $setores = Setor::all();

        return view('equipamentos.edit', compact('equipamento', 'setores')); // Passa o equipamento e setores para a view de edição
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
            'status' => 'required|string|in:disponível,indisponível,emprestado',
            'categoria_nome' => 'required|string',
            'setor_id' => 'required|string',  
        ]);

        // Encontra o equipamento ou retorna erro 404
        $equipamento = Equipamentos::findOrFail($id);

        // Criação ou obtenção do Setor
        if ($request->setor_id === 'novo') {
            // Se a opção for "novo", cria um novo setor com o nome informado
            $setor = Setor::create([
                'nome' => $request->novo_setor_nome
            ]);
        } else {
            // Caso contrário, usa o setor selecionado
            $setor = Setor::findOrFail($request->setor_id);
        }

        // Criação ou obtenção da Categoria
        $categoria = Categoria::firstOrCreate([
            'nome' => $request->categoria_nome
        ]);

        // Atualiza os dados do equipamento
        $equipamento->update([
            'nome' => $request->nome,
            'numero_serie' => $request->numero_serie,
            'status' => $request->status,
            'categoria_id' => $categoria->id,
            'setor_id' => $setor->id,
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