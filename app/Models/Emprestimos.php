<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimos extends Model
{
    use HasFactory;

    protected $table = 'emprestimos';
    protected $fillable = [
        'equipamento_id',
        'usuario_id',
        'data_emprestimo',
        'data_devolucao_prevista',
        'data_devolucao_real',
        'status'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamentos::class, 'equipamento_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id');
    }
}
