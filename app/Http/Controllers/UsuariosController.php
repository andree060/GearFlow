<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuarios::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do usuário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email', // Garante que o email seja único
            'senha' => 'required|min:6|confirmed', // Garante que a senha tenha confirmação
        ]);

        // Criação do novo usuário
        $usuario = Usuarios::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => bcrypt($request->senha),  // Criptografa a senha
        ]);

        // Após salvar, redireciona para outra página (por exemplo, para a lista de usuários)
        return redirect()->route('usuarios.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = Usuarios::find($id); // Encontra o usuário pelo ID
        return view('usuarios.show', compact('usuario')); // Exibe a view com os detalhes do usuário
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuarios::find($id); // Encontra o usuário pelo ID
        return view('usuarios.edit', compact('usuario')); // Passa o usuário para a view de edição
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validação dos dados do usuário
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email|unique:usuarios,email,' . $id, // Garante que o email seja único, ignorando o próprio ID
        'senha' => 'nullable|min:6|confirmed', // Senha é opcional no update, mas se for informada, deve ser confirmada
    ]);

    // Encontra o usuário no banco
    $usuario = Usuarios::find($id);

    if (!$usuario) {
        return redirect()->route('usuarios.index')->with('error', 'Usuário não encontrado.');
    }

    // Atualiza os dados do usuário
    $usuario->update([
        'nome' => $request->nome,
        'email' => $request->email,
        'senha' => $request->senha ? bcrypt($request->senha) : $usuario->senha, // Se a senha foi informada, atualiza
    ]);

    // Redireciona para a página de detalhes do usuário com uma mensagem de sucesso
    return redirect()->route('usuarios.show', ['id' => $usuario->id])
                     ->with('success', 'Usuário atualizado com sucesso!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = Usuarios::find($id);
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
