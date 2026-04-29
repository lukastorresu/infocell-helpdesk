<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cliente extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'endereco',
    ];

    public function chamados()
    {
        return $this->hasMany(Chamado::class, 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function telefone(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Remove todos os caracteres que não são números
                $cleaned = preg_replace('/[^0-9]/', '', $value);
                $length = strlen($cleaned);

                // Se for um celular (com DDD)
                if ($length == 11) {
                    return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $cleaned);
                }
                
                // Se for um telefone fixo (com DDD)
                if ($length == 10) {
                    return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $cleaned);
                }

                return $value;
            }
        );
    }
}
