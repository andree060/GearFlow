<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipamentos extends Model
{
    use HasFactory;

    protected $table = 'equipamentos';

    protected $fillable = [
        'nome',
        'numero_serie',
        'status', // Esse campo ainda é útil para casos como "disponível", "emprestado", etc.
        'categoria_id',
        'setor_id',
    ];

    // Relacionamentos

    public function emprestimos()
    {
        return $this->hasMany(Emprestimos::class, 'equipamento_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }

    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class, 'equipamento_id');
    }

    // Métodos auxiliares

    /**
     * Retorna o status atual com base na última manutenção.
     */
    public function statusAtual()
    {
        $ultimaManutencao = $this->manutencoes()->latest('data_manutencao')->first();

        if ($ultimaManutencao && strtolower($ultimaManutencao->status) !== 'Manutenção Concluida') {
            return 'em manutenção';
        }

        return 'Manutenção Concluida';
    }

    /**
     * Verifica se o equipamento está em manutenção.
     */
    public function isEmManutencao()
    {
        return $this->statusAtual() === 'em manutenção';
    }

    /**
     * Verifica se o equipamento está funcionando.
     */
    public function isFuncionando()
    {
        return $this->statusAtual() === 'Manutenção Concluida';
    }
}
