<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();  // Cria a chave primária 'id'
            $table->string('nome', 255);  // Cria a coluna 'nome' para o nome do equipamento
            $table->string('numero_serie', 100);  // Cria a coluna 'numero_serie' para o número de série
            $table->string('status', 100);  // Cria a coluna 'status' para armazenar o status do equipamento
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');  // Chave estrangeira para a tabela 'categorias'
            $table->foreignId('setor_id')->nullable()->constrained('setores')->onDelete('cascade');  // Chave estrangeira para a tabela 'setores'
            $table->string('usuario_responsavel')->nullable();  // Adiciona a coluna 'usuario_responsavel' para armazenar o nome do responsável
            $table->timestamps();  // Cria as colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');  // Remove a tabela se precisar reverter a migração
    }
};
