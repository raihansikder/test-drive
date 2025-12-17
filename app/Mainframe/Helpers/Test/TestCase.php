<?php

namespace App\Mainframe\Helpers\Test;

use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use ReflectionObject;
use Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, TestHelperTrait;

    public const MSG_LOOKING_FOR = '🔎️ Looking for  ';

    public const MSG_SAVE_ELEMENT = '⚙️Attempting to save an element ';

    public const MSG_CREATE_ELEMENT = '⚙️Attempting to create an element ';

    public const MSG_UPDATE_ELEMENT = '⚙️Attempting to update an element ';

    public const MSG_DELETE_ELEMENT = '⚙️Attempting to delete an element ';

    public const MSG_GET_FROM = '⚙️Attempting to get data from ';

    public const MSG_CHECK_DB = '⚙️Checking in database ';

    public const MSG_CHECK_RESPONSE_ERROR_MESSAGES = '👁️ Expecting response to contain following error message(s) :';

    public const MSG_CHECK_RESPONSE_CONTAINS = '👁️ Expecting response to contain ';

    public const MSG_CHECK_RESPONSE_CONTAINS_IN_ORDER = '👁️ Expecting content in following order ';

    public const MSG_GOT_RESPONSE_CONTENT = '↘️Got response: ';

    public const MSG_ERRORS_FOUND = '↘️⚠️Error messages found in response :';

    public const MSG_EXPECTED_ERROR_NOT_FOUND = ' ⚠️Error expected, but not found in response --> ';

    public const MSG_FETCHED_FROM_DB = '🧲 ️ Fetched existing data from DB to test with  ';

    /** @var \Faker\Generator */
    public $faker;

    public $password = 'activation1';

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->faker = Factory::create();
        // usleep(100000);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        /*
        |--------------------------------------------------------------------------
        | Memory optimization
        |--------------------------------------------------------------------------
        */
        foreach ((new ReflectionObject($this))->getProperties() as $property) {
            if (! $property->isStatic() && $property->getDeclaringClass()->getName() === __CLASS__) {
                unset($this->{$property->getName()});
            }
        }
        gc_collect_cycles();
    }
}
