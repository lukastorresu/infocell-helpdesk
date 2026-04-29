<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoChamado extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'tipos_chamado';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
    ];

    /**
     * Um Tipo de Chamado pode ser usado em vários Chamados.
     */
    public function chamados(): HasMany
    {
        return $this->hasMany(Chamado::class, 'tipo_id');
    }
}
