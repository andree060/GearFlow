<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $fillable = ['nome', 'email', 'senha'];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimos::class, 'usuario_id');
    }
}
