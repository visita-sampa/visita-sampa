<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoggedUserTest extends TestCase
{
    /** @test */
    public function check_if_login_route_is_correct()
    {
        $response = $this->get('/pt/login/');

        $response->assertStatus(200);
    }

    /** @test */
    public function only_logged_in_users_can_see_user_profile()
    {
        $response = $this->get('/pt/user')
            ->assertRedirect('/pt/login');
    }
}
