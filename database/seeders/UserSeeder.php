<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tecnico; // O model ainda se chama Tecnico
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Cria o usuário Administrador
        Tecnico::create([
            'nome' => 'Administrador',
            'email' => 'admin@test.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        // Cria o usuário Técnico
        Tecnico::create([
            'nome' => 'Leo',
            'email' => 'leozinho_araujo_bonfim@hotmail.com.br',
            'password' => Hash::make('Infoshop1193'),
            'role' => 'tecnico',
        ]);
    }
}
