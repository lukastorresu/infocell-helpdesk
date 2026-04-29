<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Tecnico;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        Tecnico::create([
            'nome' => 'Administrador',
            'email' => 'admin@test.com',
            'password' => Hash::make('123'),
            'role' => 'admin', // Definindo a função como admin
        ]);
    }
}
