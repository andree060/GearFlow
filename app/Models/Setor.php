<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setores';

    protected $fillable = [
        'nome', // Nome do setor
        // Adicione aqui outros campos, se houver
    ];

    /**
     * Relacionamento: Um setor pode ter muitos equipamentos.
     */
    public function equipamentos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Equipamentos::class, 'setor_id');
        // ⬆️ Certifique-se de que sua model se chama "Equipamento", no singular.
        // Caso contrário, deixe como estava: Equipamentos::class
    }
}
