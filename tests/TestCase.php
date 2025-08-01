<?php

namespace Tests;

use App\Mainframe\Helpers\Test\TestHelperTrait;
use App\Mainframe\Helpers\Test\TestCase as MfTestCase;

abstract class TestCase extends MfTestCase
{
    use CreatesApplication, TestHelperTrait;

    /** @var \Faker\Generator */
    public $faker;

    public $password = 'activation1';

    protected function setUp(): void
    {
        parent::setUp();
    }
}
