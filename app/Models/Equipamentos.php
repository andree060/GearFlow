<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipamentos extends Model
{
    use HasFactory;

    protected $table = 'equipamentos';
    protected $fillable = ['nome', 'numero_serie', 'status'];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimos::class, 'equipamento_id');
    }
}
