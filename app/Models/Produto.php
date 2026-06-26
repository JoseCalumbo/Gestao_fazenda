<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
 //   use SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = [
        'cooperativa_id',
        'agricultor_id',
        'talhao_id',
        'nome',
        'categoria',
        'quantidade',
        'quantidade_minima',
        'unidade',
        'preco_venda',
        'estado',
        'descricao',

    ];

    protected $casts = [
        'quantidade' => 'decimal:2',
        'quantidade_minima' => 'decimal:2',
        'preco_venda' => 'decimal:2',
    ];

    /**
     * Relacionamento: Um produto pertence a uma Cooperativa
     */
    public function cooperativa()
    {
        return $this->belongsTo(Cooperativa::class, 'cooperativa_id');
    }

    /**
     * Relacionamento: Um produto pertence a um Agricultor
     */
    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class, 'agricultor_id');
    }

    /**
     * Relacionamento: Um produto provém de um Talhão específico
     */
    public function talhao()
    {
        return $this->belongsTo(Talhao::class, 'talhao_id');
    }


    public function vendaItens()
    {
        return $this->hasMany(VendaItem::class);
    }
}
