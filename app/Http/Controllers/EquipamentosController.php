<?php

namespace App\Http\Controllers;

use App\Models\Equipamentos;
use Illuminate\Http\Request;

class EquipamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipamentos = Equipamentos::all();
        return view('equipamentos.index', compact('equipamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipamentos.create');
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
            'status' => 'required|string|max:20',
        ]);

        // Criação do equipamento
        Equipamentos::create($request->all());

        return redirect()->route('equipamentos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $equipamento = Equipamentos::find($id);
        return view('equipamentos.show', compact('equipamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipamento = Equipamentos::findOrFail($id); // Encontra o equipamento ou retorna erro 404
        return view('equipamentos.edit', compact('equipamento')); // Passa o equipamento para a view
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados do equipamento
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero_serie' => 'required|string|max:100',
            'status' => 'required|string|in:disponível,emprestado', // Verifique os status válidos no seu sistema
        ]);

        // Encontrar e atualizar o equipamento
        $equipamento = Equipamentos::findOrFail($id);
        $equipamento->update([
        'nome' => $request->nome,
        'numero_serie' => $request->numero_serie,
        'status' => $request->status,
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
