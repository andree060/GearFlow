<?php

use App\Http\Controllers\EquipamentosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\EmprestimosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Página inicial ou rota principal
Route::get('/', function () {
    return view('welcome');
});




Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');




Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// Rotas para Equipamentos
Route::get('equipamentos', [EquipamentosController::class, 'index'])->name('equipamentos.index');
Route::get('equipamentos/create', [EquipamentosController::class, 'create'])->name('equipamentos.create');
Route::post('equipamentos', [EquipamentosController::class, 'store'])->name('equipamentos.store');
Route::get('equipamentos/{id}', [EquipamentosController::class, 'show'])->name('equipamentos.show'); // Exibe detalhes do equipamento
Route::get('equipamentos/{id}/edit', [EquipamentosController::class, 'edit'])->name('equipamentos.edit'); // Editar equipamento
Route::put('equipamentos/{id}', [EquipamentosController::class, 'update'])->name('equipamentos.update'); // Atualiza o equipamento
Route::delete('equipamentos/{id}', [EquipamentosController::class, 'destroy'])->name('equipamentos.destroy'); // Exclui o equipamento

// Rotas para Usuários
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{id}', [UsuariosController::class, 'show'])->name('usuarios.show'); // Exibe detalhes do usuário
Route::get('usuarios/{id}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit'); // Editar usuário
Route::put('usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update'); // Atualiza o usuário
Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy'); // Exclui o usuário

// Rotas para Empréstimos
Route::get('emprestimos', [EmprestimosController::class, 'index'])->name('emprestimos.index');
Route::get('emprestimos/create', [EmprestimosController::class, 'create'])->name('emprestimos.create');
Route::post('emprestimos', [EmprestimosController::class, 'store'])->name('emprestimos.store');
Route::get('emprestimos/{id}', [EmprestimosController::class, 'show'])->name('emprestimos.show'); // Exibe detalhes do empréstimo
Route::get('emprestimos/{id}/edit', [EmprestimosController::class, 'edit'])->name('emprestimos.edit'); // Editar empréstimo
Route::put('emprestimos/{id}', [EmprestimosController::class, 'update'])->name('emprestimos.update'); // Atualiza o empréstimo
Route::delete('emprestimos/{id}', [EmprestimosController::class, 'destroy'])->name('emprestimos.destroy'); // Exclui o empréstimo
