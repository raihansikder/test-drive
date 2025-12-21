<?php

use App\Project\Notifications\Auth\VerifyEmail;
use App\User;

test('see registration page', function () {
    $this->get('register')
        ->assertStatus(200)
        ->assertSee('User Registration')->assertSeeInOrder([
            'Email',
            'Password',
            'Confirm Password',
            'Register',
        ]);
});

test('guest can register to default user group', function () {
    Mail::fake();
    Notification::fake();

    $firstName = $this->faker->firstName;
    $email = $this->faker->email;

    $this->followingRedirects()
        ->post('register', [
            'first_name' => $firstName,
            'last_name' => $this->faker->lastName,
            'email' => $email,
            'password' => $this->password,
            'password_confirmation' => $this->password,
            // 'group_ids' => [Group::byName('user')->id], // Note: If no group is specified then by default 'user' group will be selected
        ])
        ->assertStatus(200)
        ->assertSee('A verification link has been sent to your email address. Click the link and login with your username and password to complete the verification.');

    $user = User::where('email', $email)->first();

    // Get this newly created user from database
    Notification::assertSentTo([$user], VerifyEmail::class);

    // This is a mailable class
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'email_verified_at' => null,
        'group_ids' => '["'.User::USER_GROUP_ID.'"]',
    ]);

    echo "User #{$user->id} : {$user->email} created";

    $this->followingRedirects()
        ->post('login', [
            'email' => $user->email,
            'password' => $this->password,
        ])
        ->assertStatus(200)
        ->assertSee('Before proceeding, please check your email for a verification link.');

    $this->followingRedirects()
        ->post('email/resend')
        ->assertStatus(200)
        ->assertSee('Email verification required')
        ->assertDontSee('Resend verification link');

    Notification::assertSentTo([$user], VerifyEmail::class);
});

test('guest cannot see resend verification code page', function () {
    $this->withExceptionHandling();

    // Guest is redirected to login
    $this->get('email/verify')->assertRedirect('login');
});

test('verified user can see dashboard upon login', function () {
    $user = latest(User::class);

    $user->update(['email_verified_at' => now()]);
    // Force verify
    $this->be($user);
    $this->followingRedirects()->get('email/verify')->assertSee('Dashboard');
});

test('verified user can login and see dashboard', function () {
    $user = latest(User::class);

    // Get this newly created user from database
    $this->followingRedirects()
        ->post('login', [
            'email' => $user->email,
            'password' => $this->password,
        ])
        ->assertStatus(200)
        ->assertSee('Dashboard');
});

test('user can access data block variable', function () {
    $user = latest(User::class);

    // Get this newly created user from database
    $this->be($user);
    $this->followingRedirects()
        ->get('/')
        ->assertStatus(200)
        ->assertViewHas('sampleData', [
            'books' => [
                'purchased' => 10,
                'read' => 7,
            ],
        ]);
});

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/
