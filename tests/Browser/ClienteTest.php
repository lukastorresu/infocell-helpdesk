<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ClienteTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_admin_consegue_cadastrar_um_novo_cliente()
    {
        // Cria usuário administrador para passar pelo Middleware IsAdmin (se houver na rota)
        $admin = User::factory()->create(['role' => 'admin']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/clientes/create')
                    ->type('nome', 'Empresa Cliente Fictícia')
                    ->type('endereco', 'Rua de Teste, 123, Centro')
                    ->type('telefone', '18999999999')
                    ->type('email', 'contato@clienteficticio.com')
                    ->press('Salvar') // Altere para o nome exato do seu botão no arquivo Blade
                    ->assertPathIs('/clientes')
                    ->assertSee('Cliente cadastrado com sucesso!'); // Valida a mensagem de sessão
        });
    }

    public function test_sistema_mostra_erro_se_nome_ficar_em_branco()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/clientes/create')
                    ->type('endereco', 'Rua Sem Nome')
                    ->type('telefone', '1800000000')
                    ->press('Salvar')
                    ->assertSee('O campo nome é obrigatório.'); // Mensagem padrão de erro do Laravel
        });
    }
}