<?php

namespace Tests\Feature\Mainframe\Superadmin;

use App\Mainframe\Helpers\Test\SuperadminTestCase;

class LoginTest extends SuperadminTestCase
{
    
    /**
     * @return void
     */
    public function test_redirect_to_dashboard_from_login_url()
    {
        $this->followingRedirects()->get('/login')
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    /**
     * @return void
     */
    public function test_show_dashboard()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    /**
     * @return void
     */
    public function test_logout()
    {
        $this->withExceptionHandling();
        $this->followingRedirects()->get('/logout')
            ->assertStatus(200)
            ->assertSee('Login');
    }

}
