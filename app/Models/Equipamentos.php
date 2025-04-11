<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipamentos extends Model
{
    use HasFactory;

    protected $table = 'equipamentos';
    protected $fillable = ['nome', 'numero_serie', 'status', 'categoria_id', 'setor_id', 'usuario_responsavel'];

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

    public function usuarioResponsavel()
    {
        return $this->belongsTo(User::class, 'usuario_responsavel');
    }

    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class, 'equipamento_id');
    }

    public function statusAtual()
    {
        $ultimaManutencao = $this->manutencoes()->latest('data_manutencao')->first();

        if ($ultimaManutencao && $ultimaManutencao->status !== 'Funcionando') {
            return 'Em Manutenção';
        }

        return 'Funcionando';
    }

    public function isEmManutencao()
    {
        return $this->statusAtual() === 'Em Manutenção';
    }

    public function isFuncionando()
    {
        return $this->statusAtual() === 'Funcionando';
    }
}
