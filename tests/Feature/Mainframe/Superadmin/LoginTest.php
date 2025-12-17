<?php

beforeEach(function () {
    login(user(config('test.super_admin_user_id')));
});

test('redirect to dashboard from login url', function () {
    $this->followingRedirects()->get('/login')
        ->assertStatus(200)
        ->assertSee('Dashboard');
});

test('show dashboard', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('Dashboard');
});

test('logout', function () {
    $this->withExceptionHandling();
    $this->followingRedirects()->get('/logout')
        ->assertStatus(200)
        ->assertSee('Login');
});
