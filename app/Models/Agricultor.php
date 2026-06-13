<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agricultor extends Model
{
    protected $table = 'agricultores';

    protected $fillable = [
        'nome_completo',
        'sexo',
        'data_nascimento',
        'bilhete',
        'nif',
        'estado_civil',
        'fotografia',
        'telefone_principal',
        'telefone_alternativo',
        'email',
        'endereco',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function getIdadeAttribute()
    {
        return $this->data_nascimento
            ? $this->data_nascimento->age
            : null;
    }

    public function getInicialAttribute()
    {
        return strtoupper(substr($this->nome_completo, 0, 1));
    }

    public function getFotoUrlAttribute()
    {
        if ($this->fotografia) {
            return asset('storage/'.$this->fotografia);
        }

        return asset('images/user-default.png');
    }
}
