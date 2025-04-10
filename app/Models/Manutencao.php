<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    use HasFactory;

    // Defina o nome correto da tabela
    protected $table = 'manutencao';  // Use o nome correto da tabela no banco de dados

    protected $fillable = [
        'equipamento_id',
        'data_manutencao',
        'descricao',
        'responsavel',
        'status',
        'custo',
        'proxima_manutencao',
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamentos::class, 'equipamento_id'); // Especificando a chave estrangeira
    }

}
