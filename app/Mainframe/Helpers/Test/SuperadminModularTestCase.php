<?php

/** @noinspection PhpUndefinedClassInspection */

namespace App\Mainframe\Helpers\Test;

use App\User;

class SuperadminModularTestCase extends UserModularTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::remember(timer('long'))->find(config('test.super_admin_user_id'));
        $this->be($this->user); // Impersonate as the currently created admin user
    }
}
