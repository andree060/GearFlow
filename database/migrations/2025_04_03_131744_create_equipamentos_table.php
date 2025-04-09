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
            $table->id();
            $table->string('nome', 255);
            $table->string('numero_serie', 100);
            $table->string('status', 100);
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');
            $table->foreignId('setor_id')->nullable()->constrained('setores')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');
    }
};
