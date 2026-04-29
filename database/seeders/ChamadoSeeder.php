<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chamado;

class ChamadoSeeder extends Seeder
{
    public function run(): void
    {
        // Alterado de 'tecnico_id' para 'user_id'
        Chamado::create(['descricao' => 'Tela de um Redmi 9T trocada, aparelho já foi mexido antes para reparo de placa.', 'tipo_id' => 1, 'cliente_id' => 1, 'user_id' => 2, 'concluido' => true, 'valor_total' => 150.00]);
        Chamado::create(['descricao' => 'Troca de tela de um iPhone 8 na cor branca, cliente pagou no pix', 'tipo_id' => 1, 'cliente_id' => 2, 'user_id' => 2, 'concluido' => true, 'valor_total' => 200.00]);
        Chamado::create(['descricao' => 'Troca apenas da tela de um Redmi Note 7, aparelho entrou com tampa quebrada e bateria inchada.', 'tipo_id' => 1, 'cliente_id' => 3, 'user_id' => 2, 'concluido' => true, 'valor_total' => 180.00]);
        Chamado::create(['descricao' => 'Troca de tela do A14 5G', 'tipo_id' => 1, 'cliente_id' => 4, 'user_id' => 2, 'concluido' => true, 'valor_total' => 250.00]);
        Chamado::create(['descricao' => 'Troca de tela com aro do G9 Play', 'tipo_id' => 1, 'cliente_id' => 5, 'user_id' => 2, 'concluido' => true, 'valor_total' => 220.00]);
    }
}
