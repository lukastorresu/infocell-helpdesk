<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create(['nome' => 'Claudinei Sassaki', 'telefone' => '(18) 99742-6781', 'endereco' => 'Rua Maria Guevara Branco, 499 - Brasil Novo']);
        Cliente::create(['nome' => 'Cleiton Alexandre Ferreira Junior', 'telefone' => '(18) 99765-8704', 'endereco' => 'Rua Sebastião Paqui Rosílio 111']);
        Cliente::create(['nome' => 'Berta Lucia', 'telefone' => '(18) 99779-9705', 'endereco' => 'Rua Anibal Pimenta, 173 - Jd Maracanã', 'mal_pagador' => true]);
        Cliente::create(['nome' => 'Greice Ribeiro', 'telefone' => '(18) 98808-1024', 'endereco' => 'Rua 12 de outubro, 1845']);
        Cliente::create(['nome' => 'Ester Cardoso dos Santos', 'telefone' => '1839039251', 'endereco' => 'Casa de repouso Tom de Amor']);
    }
}
