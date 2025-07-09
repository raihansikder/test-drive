<?php

use App\Module;
use App\Setting;
use App\Mainframe\Helpers\Mf;
use Illuminate\Support\MessageBag;

/**
 * Get mainframe config
 * from config/mainframe/config.php
 *
 * @param $key
 * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
 */
function mf_config($key)
{
    return Mf::config($key);
}

/**
 * Project config
 *
 * @param $key
 * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
 */
function project_config($key)
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
 * Get project name. This is a CamelCase name of the project
 *
 * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
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

function projectDir()
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
 * returns sentry object of currently logged in user
 *
 * @param  bool|null  $id
 * @return \Illuminate\Contracts\Auth\Authenticatable|\App\User
 */
function user($id = null)
{
    return Mf::user($id);
}

/**
 * Alias function for user
 *
 * @param  null  $id
 * @return \App\User|\Illuminate\Contracts\Auth\Authenticatable
 */
function logged($id = null)
{
    return user($id);
}

/**
 * Get bearer user
 *
 * @return \Illuminate\Contracts\Auth\Authenticatable
 */
function bearer()
{
    return Auth::guard('bearer')->user();
}

/**
 * Get bearer user
 *
 * @return \Illuminate\Contracts\Auth\Authenticatable
 */
function apiCaller()
{
    return Auth::guard('x-auth')->user();
}

/**
 * Get a cached version of active modules.
 *
 * @return \App\Module[]|mixed
 */
function modules()
{
    return Mf::modules();
}

/**
 * Short-hand function to get module by name
 *
 * @param $name
 * @return \App\Module|mixed
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
 * @param $name
 * @return null|array|bool|mixed|string
 */
function setting($name)
{
    return Setting::read($name);
}

/**
 * Cache key for a specific request / url + user
 *
 * @param  string  $append
 * @return string
 */
function urlKey($append = '', $except = [])
{
    return Mf::urlKey($append, $except);
}

/**
 * Cache key for a specific request / url without user encoded
 *
 * @param  string  $append
 * @return string
 */
function statelessUrlKey($append = '', $except = [])
{
    return Mf::statelessUrlKey($append, $except);
}

/**
 * Get cached data
 * @param  string  $key  kebab-case string input
 * @param  null  $seconds
 * @return mixed
 */
function cached($key, $seconds = null)
{
    $cached = new Cached();
    $cached->key = $key;
    $function = lcfirst(Str::camel($key)); //camelCaseFunction

    if (isset($seconds) && $seconds < 1) {
        Cache::forget($key);
    }

    return $cached->$function($seconds);
}

/**
 * Get time in seconds
 *
 * @param  null  $key
 * @return \Illuminate\Config\Repository|int|mixed
 */
function timer($key = null)
{
    return \App\Mainframe\Helpers\Cache::time($key);
}

/**
 * returns absolute path from a relative path
 *
 * @param $relativePath
 * @return string
 */
function absPath($relativePath)
{
    return public_path().$relativePath;
}

/**
 * Return md5 key for a query.
 *
 * @param $query \Illuminate\Database\Query\Builder
 * @return string
 */
function querySignature($query)
{
    return md5($query->toSql().json_encode($query->getBindings()));
}

function error($message = '', $setMsg = true, $ret = false)
{
    $key = 'errors';
    if ($setMsg && strlen($message)) {
        if (!in_array($message, Session::get($key, []))) {
            // Session::push($key, $message);
        }
        resolve(MessageBag::class)->add($key, $message);
    }

    return $ret;
}

function message($message = '', $setMsg = true, $ret = false)
{
    $key = 'messages';
    if ($setMsg && strlen($message)) {
        if (!in_array($message, Session::get($key, []))) {
            // Session::push($key, $message);
        }
        resolve(MessageBag::class)->add($key, $message);
    }

    return $ret;
}

/**
 * This function pushes an error string to 'error' array of session.
 *
 * @param  string  $message
 * @param  bool  $ret
 * @param  bool  $setMsg
 * @return bool
 * @deprecated use error()
 */
function setError($message = '', $setMsg = true, $ret = false)
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
 * @param $key
 * @param  string  $part
 * @return mixed|null
 */
function content($key, $part = 'body')
{
    return Mf::content($key, $part);
}

/**
 * Get Kebab-case key based on a class name
 *
 * @param  stdClass|string|mixed  $class
 * @return string my-class-name
 */
function classKey($class)
{
    if (is_string($class)) {
        return Str::slug(Str::kebab(className($class)));
    }

    return Str::slug(Str::kebab(class_basename($class)));
}

/**
 * Get the class name from key. my-demo-class -> MyDemoClass
 *
 * @param $key
 * @return string
 */
function classFromKey($key)
{
    return Str::ucfirst(Str::camel($key));
}

/**
 * variableCase form class
 *
 * @param  stdClass|string  $class
 * @return string myClassName
 */
function classVar($class)
{
    if (is_string($class)) {
        return lcfirst(className($class));
    }

    return lcfirst(class_basename($class));
}

/**
 * Snake case key of class
 *
 * @param  stdClass|string  $class
 * @return string my_class_name
 */
function classSnakeKey($class)
{
    if (is_string($class)) {
        return Str::snake(className($class));
    }

    return Str::snake(class_basename($class));
}

/**
 * @param  stdClass|string  $class
 * @return mixed|string
 */
function className($class)
{
    if (is_string($class)) {
        $pieces = explode('\\', $class);

        return array_pop($pieces);
    }

    return class_basename($class);
}

/**
 * Add params to an existing url
 *
 * @param $url
 * @param  string|array|null  $params
 * @return string
 */
function urlWithParams($url, $params = null)
{
    return Mf::link($url, $params);
}

/**
 * Flatten array keys
 *
 * @param $array
 * @param $keys
 * @return array|mixed
 */
function array_flat_keys($array, $keys = [])
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
 * @param  string  $bucket  bucket name i.e. public
 * @param  int  $tenant  Tenant id
 * @return string
 */
function uploadDir($bucket = null, $tenant = null)
{
    $dir = $bucket ?: trim(config('mainframe.config.upload_root'), "\\/ ");
    $tenant = $tenant ?: '0';

    $dir .= '/'.$tenant;

    // ->public/files/{tenant_id}/2021/12/25/23/59
    $dir .= '/'.date('Y').'/'.date('m').'/'.date('d').'/'.date('H').'/'.date('i');

    return $dir;
}

/**
 * Exclude some items from one-dimensional array
 *
 * @param $array
 * @param  array  $except
 * @return mixed
 */
function array_excludes($array, array $except)
{
    $temp = [];
    foreach ($array as $item) {
        if (!in_array($item, $except)) {
            $temp[] = $item;
        }
    }

    return $temp;
}

/**
 * Check if array keys are equal or not
 *
 * @param $array1
 * @param $array2
 * @return bool
 */
function array_keys_equal($array1, $array2)
{
    sort($array1);
    sort($array2);

    return !array_diff_key($array1, $array2) && !array_diff_key($array2, $array1);
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
