<?php

namespace Tests\Feature\Mainframe\Superadmin;

use App\Mainframe\Helpers\Test\SuperadminTestCase;

class LoginTest extends SuperadminTestCase
{
    
    /**
     * Test if authenticated user is redirected to dashboard when accessing login URL
     *
     * @test
     * @return void
     */
    public function test_redirect_to_dashboard_from_login_url()
    {
        $this->followingRedirects()->get('/login')
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    /**
     * Test if authenticated user can access and view the dashboard
     *
     * @test
     * @return void
     */
    public function test_show_dashboard()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    /**
     * Test if user can successfully logout and be redirected to login page
     *
     * @test
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
