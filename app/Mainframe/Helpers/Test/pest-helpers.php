<?php

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Console\Kernel;

/**
 * Log in the given user.
 *
 * @return \Tests\TestCase
 */
function login($user = null)
{
    if (is_int($user)) {
        $user = User::find($user);
    }

    return test()->actingAs($user);
}

/**
 * @return \Illuminate\Database\Eloquent\Model|Authenticatable|object|null
 */
function latest(string $class)
{
    return test()->latest($class);
}

/**
 * Sample image base64 encoded string
 *
 * @return string
 */
function base64Image()
{
    /** @noinspection SpellCheckingInspection */
    return 'iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAIAAADTED8xAAADMElEQVR4nOzVwQnAIBQFQYXff81RUkQCOyDj1YOPnb'.
        'XWPmeTRef+/3O/OyBjzh3CD95BfqICMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0'.
        'CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0C'.
        'MK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CM'.
        'K0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK'.
        '0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0'.
        'CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0C'.
        'MK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CM'.
        'K0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK'.
        '0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0'.
        'CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0C'.
        'MK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CM'.
        'K0CMK0CMK0CMK0CMO0TAAD//2Anhf4QtqobAAAAAElFTkSuQmCC';
}

/**
 * A generic boot function for Laravel applications.
 *
 * @return mixed
 */
function boot()
{
    $app = require __DIR__.'/../../../../bootstrap/app.php';
    $app->make(Kernel::class)->bootstrap();
    restore_error_handler();
    restore_exception_handler();

    return $app;
}

/**
 * Remove system fields from the given model array.
 *
 * This function strips the specified fields, or the default system fields,
 * from a given array representation of a model. The default fields to be
 * removed include 'id', 'uuid', 'created_by', 'updated_by', 'created_at', and 'updated_at'.
 *
 * @param  array  $model  The array representation of the model.
 * @param  array|null  $removeFields  An optional array of fields to be removed. Defaults to system fields.
 * @return array The filtered array with the specified system fields removed.
 */
function unsetSystemFields(array $model, ?array $removeFields = null)
{
    $removeFields = $removeFields ?? ['id', 'uuid', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    $dotArray = Arr::dot($model);

    foreach ($dotArray as $key => $value) {
        foreach ($removeFields as $removeField) {
            if ($key === $removeField || Str::endsWith($key, '.'.$removeField)) {
                unset($dotArray[$key]);
            }
        }
    }

    return Arr::undot($dotArray);
}
