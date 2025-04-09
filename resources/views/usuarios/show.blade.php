@extends('layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')

    <!-- Título da página com cor personalizada -->
    <h1 class="text-center mb-4 font-weight-bold" style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
        Detalhes do Usuário
    </h1>

    <div class="container mt-5">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cartão com detalhes do usuário -->
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Tabela de detalhes -->
                <table class="table table-striped">
                    <tr>
                        <th>Nome</th>
                        <td>{{ $usuario->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $usuario->email }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-start gap-2">
                    <!-- Botão Editar -->
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning w-auto shadow-sm rounded-pill text-white">
                        <i class="fas fa-edit"></i> Editar
                    </a>

                    <!-- Botão Voltar com cor fixa -->
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary w-auto shadow-sm rounded-pill" style="background-color: #6c757d; color: white;">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection
