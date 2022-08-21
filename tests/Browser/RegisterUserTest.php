<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class RegisterUserTest extends DuskTestCase
{
    /** @test */
    public function check_if_root_is_correct()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/pt/home')
                    ->assertSee('Explore eventos');
        });
    }

    /** @test */
    public function check_if_login_function_is_working()
    {
        $this->browse(function(Browser $browser) {
            $browser->visit('pt/login')
                ->type('login', 'usertest@test.com')
                ->type('passwordLogin', 'Senha*123')
                ->press('Entrar')
                ->assertPathIs('/pt/user');
        });
    }

    /** @test */
    public function check_if_register_function_is_working()
    {
        $this->browse(function(Browser $browser) {
            $browser->visit('pt/login')
                ->type('nameSignup', 'User Test')
                ->type('usernameSignup', 'utest')
                ->type('emailSignup', 'usertest@test.com')
                ->type('passwordSignup', 'Senha*123')
                ->press('Cadastrar')
                ->assertPathIs('/pt/user');
        });
    }
}
