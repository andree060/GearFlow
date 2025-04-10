<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipamentos extends Model
{
    use HasFactory;

    protected $table = 'equipamentos';
    protected $fillable = ['nome', 'numero_serie', 'status', 'categoria_id', 'setor_id', 'usuario_responsavel'];

    // Relacionamento com os Empréstimos
    public function emprestimos()
    {
        return $this->hasMany(Emprestimos::class, 'equipamento_id');
    }

    // Relacionamento com Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relacionamento com Setor
    public function setor()
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }

    // Relacionamento com o Usuário (Responsável)
    public function usuarioResponsavel()
    {
        return $this->belongsTo(User::class, 'usuario_responsavel');
    }
    
}
