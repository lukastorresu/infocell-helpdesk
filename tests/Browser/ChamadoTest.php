<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Cliente;
use App\Models\TipoChamado;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChamadoTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_tecnico_consegue_abrir_um_novo_chamado()
    {
        // 1. Prepara o cenário: Cria os dados que o formulário precisa nas Selects
        $tecnico = User::factory()->create(['role' => 'tecnico', 'nome' => 'Luke Técnico']);
        $cliente = Cliente::factory()->create(['nome' => 'Cliente Alpha']);
        $tipo = TipoChamado::factory()->create(['nome' => 'Manutenção Preventiva']);

        $this->browse(function (Browser $browser) use ($tecnico, $cliente, $tipo) {
            $browser->loginAs($tecnico)
                    ->visit('/chamados/create')
                    // Como são selects, usamos o método select('name_do_campo', 'value')
                    ->select('cliente_id', (string) $cliente->id)
                    ->select('tecnico_id', (string) $tecnico->id)
                    ->select('tipo_id', (string) $tipo->id)
                    ->type('descricao', 'Computador com lentidão na inicialização do Windows.')
                    ->press('Salvar')
                    ->assertPathIs('/chamados')
                    ->assertSee('Chamado aberto com sucesso!');
        });
    }

    public function test_fechar_chamado_exige_valor_total()
    {
        $tecnico = User::factory()->create(['role' => 'tecnico']);
        $cliente = Cliente::factory()->create();
        $tipo = TipoChamado::factory()->create();
        
        // Cria um chamado aberto direto no banco
        $chamado = \App\Models\Chamado::create([
            'cliente_id' => $cliente->id,
            'user_id' => $tecnico->id,
            'tipo_id' => $tipo->id,
            'descricao' => 'Teste',
            'concluido' => false
        ]);

        $this->browse(function (Browser $browser) use ($tecnico, $chamado) {
            $browser->loginAs($tecnico)
                    ->visit("/chamados/{$chamado->id}/edit")
                    ->check('concluido') // Simula marcar a checkbox/radio de conclusão
                    ->type('valor_total', '') // Deixa vazio propositalmente
                    ->press('Atualizar')
                    ->assertSee('O campo valor total é obrigatório ao concluir um chamado.'); // Mensagem personalizada do seu Controller
        });
    }
}