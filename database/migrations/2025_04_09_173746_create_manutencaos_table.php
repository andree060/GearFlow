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
        Schema::create('manutencao', function (Blueprint $table) {
            $table->id();  // Cria a chave primária 'id'
            $table->foreignId('equipamento_id')->constrained('equipamentos')->onDelete('cascade');  // Chave estrangeira para a tabela 'equipamentos'
            $table->date('data_manutencao');  // Data da manutenção
            $table->text('descricao');  // Descrição detalhada da manutenção
            $table->string('responsavel', 255);  // Nome do responsável pela manutenção
            $table->string('status', 50);  // Status da manutenção (Ex: Funcionando, Em Manutenção, etc.)
            $table->decimal('custo', 8, 2)->nullable();  // Custo da manutenção, opcional
            $table->date('proxima_manutencao')->nullable();  // Data da próxima manutenção, opcional
            $table->timestamps();  // Cria as colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manutencao');  // Remove a tabela de manutenção, caso precise reverter a migração
    }
};
