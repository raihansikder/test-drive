<?php

/**
 * Deprecated after pest
 */

namespace App\Mainframe\Helpers\Test;

use App\User;

class SuperadminTestCase extends UserTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::remember(timer('long'))->find(env('TEST_SUPERADMIN_USER_ID'));
        $this->be($this->user); // Impersonate as the currently created admin user
    }
}
