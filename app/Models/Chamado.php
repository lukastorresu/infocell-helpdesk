<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chamado extends Model
{
    use HasFactory;

    protected $table = 'chamados';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'descricao',
        'tipo_id',
        'cliente_id',
        'user_id',
        'concluido',
        'valor_total',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'user_id');
    }
    
    public function tipoChamado(): BelongsTo
    {
        return $this->belongsTo(TipoChamado::class, 'tipo_id');
    }
}
