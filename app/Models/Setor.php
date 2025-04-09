<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setores';
    protected $fillable = ['nome']; // Nome do setor, você pode adicionar outros campos se necessário

    // Relacionamento com Equipamentos
    public function equipamentos()
    {
        return $this->hasMany(Equipamentos::class, 'setor_id');
    }
}
