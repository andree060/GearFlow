<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $fillable = ['nome']; // Nome da categoria, você pode adicionar outros campos se necessário

    // Relacionamento com Equipamentos
    public function equipamentos()
    {
        return $this->hasMany(Equipamentos::class, 'categoria_id');
    }
}
