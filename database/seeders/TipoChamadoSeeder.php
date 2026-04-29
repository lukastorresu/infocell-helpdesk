<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoChamado;

class TipoChamadoSeeder extends Seeder
{
    public function run(): void
    {
        TipoChamado::create(['nome' => 'Troca de tela', 'descricao' => 'Troca simples de tela']);
        TipoChamado::create(['nome' => 'Troca de placa de carga', 'descricao' => 'Troca simples da placa de carga']);
        TipoChamado::create(['nome' => 'Troca de bateria', 'descricao' => 'Troca simples de bateria, Android ou iPhone']);
        TipoChamado::create(['nome' => 'Troca de tampa (Android)', 'descricao' => 'Troca da tampa de um celular Android']);
        TipoChamado::create(['nome' => 'Troca de tampa (iPhone)', 'descricao' => 'Troca de tampa de aparelho Apple']);
    }
}
