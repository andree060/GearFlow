@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')

<!-- Título da página com cor personalizada -->
<h1 class="text-center mb-4 font-weight-bold"
    style="font-size: 3rem; color: #343a40; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
    Lista de Usuários
</h1>

<div class="container mt-5">

    <!-- Tabela de Usuários -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm rounded-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td class="align-middle">{{ $usuario->id }}</td>

                    <td class="align-middle text-truncate" style="max-width: 200px;">
                        {{ $usuario->name }}
                    </td>

                    <td class="align-middle text-truncate" style="max-width: 250px;">
                        {{ $usuario->email }}
                    </td>

                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            <!-- Botão Visualizar -->
                            <a href="{{ route('usuarios.show', $usuario->id) }}"
                                class="btn btn-info btn-sm text-white px-2 py-1" title="Visualizar">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Botão Editar -->
                            <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                class="btn btn-warning btn-sm text-white px-2 py-1" onclick="return confirmEdit()"
                                title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Formulário Excluir -->
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                onsubmit="return confirmDelete()" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white px-2 py-1"
                                    title="Excluir">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botão de Voltar alinhado à direita -->
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('home.index') }}" class="btn btn-secondary w-auto shadow-sm rounded-pill"
            style="background-color: #6c757d; color: white;">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

</div>

@endsection

@section('scripts')
<!-- Script JavaScript para confirmação -->
<script>
function confirmDelete() {
    return confirm('Tem certeza que deseja excluir este usuário?');
}

function confirmEdit() {
    return confirm('Tem certeza que deseja editar este usuário?');
}
</script>
@endsection