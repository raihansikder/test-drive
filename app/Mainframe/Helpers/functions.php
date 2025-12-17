<?php

/** @noinspection PhpUnused */

use App\Mainframe\Helpers\Mf;
use App\Module;
use App\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\Builder;

/**
 * Get mainframe config
 * from config/mainframe/config.php
 *
 * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
 */
function mf_config($key): mixed
{
    return Mf::config($key);
}

/**
 * Project config
 *
 * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
 */
function project_config($key): mixed
{
    return Mf::projectConfig($key);
}

/**
 * Mainframe classes root namespace
 *
 * @return string
 */
function mfNamespace()
{
    return Mf::namespace();
}

/**
 * Mainframe resource root
 *
 * @return string
 */
function mfResources()
{
    return Mf::resources();
}

/**
 * Mainframe public root directory
 *
 * @return string
 */
function mfPublic()
{
    return Mf::public();
}

/**
 * Get the project name. This is a CamelCase name of the project
 *
 * @return string|null
 */
function project()
{
    return Mf::project();
}

/**
 * Kebab case key of the project name
 *
 * @return string
 */
function projectKey()
{
    return Mf::projectKey();
}

/**
 * Project root name space
 *
 * @return string
 */
function projectNamespace()
{
    return Mf::projectNamespace();
}

function projectDir(): string
{
    return Mf::projectDir();
}

/**
 * Project resource root
 *
 * @return string
 */
function projectResources()
{
    return Mf::projectResources();
}

/**
 * Project public root directory
 *
 * @return string
 */
function projectPublic()
{
    return Mf::projectPublic();
}

/**
 * Returns sentry object of a currently logged-in user
 *
 * @return \App\User
 */
function user(?bool $id = null)
{
    return Mf::user($id);
}

/**
 * Alias function for user()
 *
 * @return \App\User
 */
function logged(?int $id = null)
{
    return user($id);
}

/**
 * Get bearer user
 *
 * @return \App\User
 */
function bearer()
{
    return Auth::guard('bearer')->user();
}

/**
 * Get bearer user
 *
 * @return \App\User
 */
function apiCaller()
{
    return Auth::guard('x-auth')->user();
}

/**
 * Get a cached version of active modules.
 *
 * @return Collection<Module>
 */
function modules()
{
    return Mf::modules();
}

/**
 * Shorthand function to get module by name
 *
 * @return \App\Module|null
 */
function module($name)
{
    return Module::byName($name);
}

/**
 * Generate uuid
 *
 * @return string
 */
function uuid()
{
    return (string) Str::uuid();
}

/**
 * Get setting by name
 *
 * @return null|mixed
 */
function setting($name)
{
    return Setting::read($name);
}

/**
 * Cache key for a specific request / url + user
 *
 * @return string
 */
function urlKey(string $append = '', array $except = [])
{

    $except = Arr::wrap($except);

    return Mf::urlKey($append, $except);
}

/**
 * Cache key for a specific request / url without user encoded
 *
 * @return string
 *
 * @noinspection PhpUnused
 */
function statelessUrlKey(string $append = '', array $except = [])
{
    return Mf::statelessUrlKey($append, $except);
}

/**
 * Get cached data
 *
 * @param  string  $key  kebab-case string input
 * @return mixed
 */
function cached(string $key, ?int $seconds = null)
{
    $cached = new Cached;
    $cached->key = $key;
    $function = lcfirst(Str::camel($key)); // camelCaseFunction

    if ($seconds !== null && $seconds < 1) {
        Cache::forget($key);
    }

    return $cached->$function($seconds);
}

/**
 * Get cached timer
 */
function timer(?string $key = null): int
{
    return \App\Mainframe\Helpers\Cache::time($key);
}

/**
 * returns an absolute path from a relative path
 *
 * @return string relative path
 */
function absPath($relativePath)
{
    return public_path().$relativePath;
}

/**
 * Return the md5 key for a query.
 *
 * @return string
 */
function querySignature(Builder|\Illuminate\Database\Query\Builder $query)
{
    return md5($query->toSql().json_encode($query->getBindings()));
}

/**
 * Add an error in the MessageBag
 */
function error(string $message = '', bool $setMsg = true, bool $ret = false): bool
{
    $key = 'errors';
    if ($setMsg && $message !== '') {
        // Push message to session
        // if (! in_array($message, Session::get($key, []))) {
        //     // Session::push($key, $message);
        // }
        resolve(MessageBag::class)->add($key, $message);
    }

    return $ret;
}

/**
 * Add a neutral message in the MessageBag
 */
function message(string $message = '', bool $setMsg = true, bool $ret = false): bool
{
    $key = 'messages';
    if ($setMsg && $message !== '') {
        // Push message to session
        // if (! in_array($message, Session::get($key, []))) {
        //     // Session::push($key, $message);
        // }
        resolve(MessageBag::class)->add($key, $message);
    }

    return $ret;
}

/**
 * This function pushes an error string to the 'error' array of the session.
 *
 * @return bool
 *
 * @deprecated use error()
 */
function setError(string $message = '', bool $setMsg = true, bool $ret = false)
{
    return error($message, $setMsg, $ret);
}

/**
 * Resolve singleton messageBag
 *
 * @return \Illuminate\Contracts\Foundation\Application|MessageBag|mixed
 */
function messageBag()
{
    return resolve(MessageBag::class);
}

/**
 * Get content
 *
 * @return string|null
 */
function content($key, string $part = 'body')
{
    return Mf::content($key, $part);
}

/**
 * Get Kebab-case key based on a class name
 *
 * @param  stdClass|string|mixed  $class
 * @return string my-class-name
 */
function classKey(mixed $class)
{
    if (is_string($class)) {
        return Str::slug(Str::kebab(className($class)));
    }

    return Str::slug(Str::kebab(class_basename($class)));
}

/**
 * Get the class name from a key. 'my-demo-class' -> MyDemoClass
 */
function classFromKey($key): string
{
    return Str::ucfirst(Str::camel($key));
}

/**
 * variableCase form class
 *
 * @return string myClassName
 */
function classVar(mixed $class): string
{
    if (is_string($class)) {
        return lcfirst(className($class));
    }

    return lcfirst(class_basename($class));
}

/**
 * Snake case key of class
 *
 * @return string my_class_name
 */
function classSnakeKey(mixed $class): string
{
    if (is_string($class)) {
        return Str::snake(className($class));
    }

    return Str::snake(class_basename($class));
}

/**
 * Return only class name excluding namespace from a string or stdClass
 *
 * @return string
 */
function className(mixed $class)
{
    if (is_string($class)) {
        $pieces = explode('\\', $class);

        return array_pop($pieces);
    }

    return class_basename($class);
}

/**
 * Add params to an existing url
 */
function urlWithParams($url, array|string|null $params = null): string
{
    return Mf::link($url, $params);
}

/**
 * Flatten array keys for a multidimensional array
 *
 * $array = [
 *  'user' => [
 *  'name' => 'John',
 *  'email' => 'john@example.com'
 * ],
 *  'settings' => [
 *  'theme' => 'dark',
 *  'language' => 'en'
 * ]
 * ];
 *
 * $keys = array_flat_keys($array, []);
 * // Result: ['user', 'name', 'email', 'settings', 'theme', 'language']
 */
function array_flat_keys($array, array $keys = []): array
{
    foreach ($array as $key => $value) {
        $keys[] = $key;

        if (is_array($value) && count($value)) {
            $keys = array_merge($keys, array_flat_keys($value, $keys));
        }
    }

    return array_unique($keys);
}

/**
 * @param  string|null  $bucket  bucket name i.e., public
 * @param  int|null  $tenant  Tenant Id
 */
function uploadDir(?string $bucket = null, ?int $tenant = null): string
{
    $dir = $bucket ?: trim(config('mainframe.config.upload_root'), '\\/ ');
    $tenant = $tenant ?: 0;

    $dir .= '/'.$tenant;

    // Generate: public/files/{tenant_id}/2021/12/25/23/59
    $dir .= '/'.date('Y').'/'.date('m').'/'.date('d').'/'.date('H').'/'.date('i');

    return $dir;
}

/**
 * Exclude some items from a one-dimensional array
 */
function array_excludes($array, array $except): array
{
    $temp = [];
    foreach ($array as $item) {
        if (! in_array($item, $except)) {
            $temp[] = $item;
        }
    }

    return $temp;
}

/**
 * Check if array keys are equal or not
 */
function array_keys_equal($array1, $array2): bool
{
    sort($array1);
    sort($array2);

    return ! array_diff_key($array1, $array2) && ! array_diff_key($array2, $array1);
}

/**
 * Call this function before file download. This clears the output buffer that may have invalid content which
 * can impact the file
 *
 * @return void
 */
function clean_output_buffer()
{
    if (ob_get_level()) { // Clean output buffer
        ob_clean();
        ob_end_clean(); // Note- Use this to solve download open issue
    }
}

// /**
//  * Add items to an existing array
//  *
//  * @param array $add
//  * @return array
//  */
// if (!function_exists('array_add')) {
//     function array_add($array, $add = [])
//     {
//         return array_unique(array_merge($array, $add));
//     }
// }

/**
 * Remove items from an existing array
 */
function array_remove($array, array $remove = []): array
{
    $filtered = array_diff($array, $remove);

    return array_values($filtered);
}
