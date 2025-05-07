<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Após salvar, redireciona para outra página (por exemplo, para a lista de usuários)
        return redirect()->route('usuarios.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::find($id); // Encontra o usuário pelo ID
        return view('usuarios.show', compact('usuario')); // Exibe a view com os detalhes do usuário
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::find($id); // Encontra o usuário pelo ID
        return view('usuarios.edit', compact('usuario')); // Passa o usuário para a view de edição
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados do usuário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Garante que o email seja único, ignorando o próprio ID
            'password' => 'nullable|min:6|confirmed', // Senha é opcional no update, mas se for informada, deve ser confirmada
        ]);
    
        // Encontra o usuário no banco
        $usuario = User::find($id);
    
        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuário não encontrado.');
        }
    
        // Atualiza os dados do usuário
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $usuario->password,
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
        $usuario = User::find($id);
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}