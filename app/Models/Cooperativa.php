<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cooperativa extends Model
{
    // public function membros()
    // {
    //     return $this->hasMany(CooperativaMembro::class);
    // }

    // Relacionamento com a tabela pivot para listar os membros desta cooperativa
    public function membros()
    {
        return $this->hasMany(CooperativaMembro::class, 'cooperativa_id');
    }

    // Opcional: Atalho direto para listar apenas os membros que estão atualmente ativos
    public function membrosAtivos()
    {
        return $this->hasMany(CooperativaMembro::class, 'cooperativa_id')->where('activo', true);
    }
}
