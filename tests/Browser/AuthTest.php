<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations; // Reseta o banco de dados de teste a cada execução

    public function test_usuario_consegue_se_registrar()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register') // Ajuste para o texto real do seu botão/título
                    ->type('name', 'Luke Torres') 
                    ->type('email', 'luke@helpdesk.com')
                    ->type('password', 'SenhaForte123!')
                    ->type('password_confirmation', 'SenhaForte123!')
                    ->press('Register') // Ajuste para o texto do botão (ex: 'Registrar')
                    ->assertPathIs('/dashboard'); // Verifica se foi redirecionado
        });
    }

    public function test_usuario_consegue_fazer_login()
    {
        // Cria um usuário falso no banco de testes
        $user = User::factory()->create([
            'email' => 'admin@helpdesk.com',
            'password' => bcrypt('senha123'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'senha123')
                    ->press('Login') // Ajuste para 'Entrar' se estiver em PT-BR
                    ->assertPathIs('/dashboard')
                    ->assertSee($user->name);
        });
    }
}