<?php

/** @noinspection PhpUnused */

namespace App\Mainframe\Helpers;

use App\Content;
use App\Module;
use App\ModuleGroup;
use App\User;
use Arr;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Schema;

/**
 * Class Mf
 */
class Mf
{
    /*
    |--------------------------------------------------------------------------
    | System functions
    |--------------------------------------------------------------------------
    |
    | Mainframe requires a set of functions to bootstrap its features.
    |
    */

    /**
     * Mainframe classes root namespace
     *
     * @return string
     */
    public static function namespace()
    {
        return 'App\Mainframe';
    }

    /**
     * Mainframe resource root
     *
     * @return string
     */
    public static function resources()
    {
        return 'mainframe';
    }

    /**
     * Mainframe public root directory
     *
     * @return string
     */
    public static function public()
    {
        return 'mainframe';
    }

    /**
     * Get a mainframe config from config/mainframe/config.php
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function config($key)
    {
        return config('mainframe.config.'.$key);
    }

    /**
     * Get the project name. This is a CamelCase name of the project
     *
     * @return string|null
     */
    public static function project()
    {
        return ucfirst(Str::camel(config('mainframe.config.project')));
    }

    /**
     * Kebab case key of the project name
     *
     * @return string
     */
    public static function projectKey()
    {
        return config('mainframe.config.project_key') ?? \Str::kebab(self::project());
    }

    /**
     * Project root name space
     *
     * @return string
     */
    public static function projectNamespace()
    {
        return config('mainframe.config.project_namespace') ?? '\App\\'.self::project(); // Old: '\App\Projects\\'.self::project()

    }

    /**
     * Get project directory app/Project
     *
     * @return string
     */
    public static function projectDir()
    {
        $dir = config('mainframe.config.project_directory') ?? str_replace('\\', '/', self::projectNamespace());

        return lcfirst(trim($dir, '\\/')); // changes App->app
    }

    /**
     * Project resource root
     *
     * @return string
     */
    public static function projectResources()
    {
        return config('mainframe.config.project_resource') ?? self::projectKey(); // Old:  'projects.'.self::projectKey()
    }

    /**
     * Project public root directory
     *
     * @return string
     */
    public static function projectPublic()
    {
        return config('mainframe.config.project_public_directory') ?? self::projectKey(); // Old: 'projects/'.self::projectKey()
    }

    /**
     * Project config
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function projectConfig($key)
    {
        $config = config('mainframe.config.project_config') ?? self::projectKey().'.config'; // Old: 'projects.'.self::projectKey().'.config'

        return config($config.'.'.$key);
    }

    /**
     * Common function to get the current user.
     * Do not change this function.
     *
     * @return \App\User|\Illuminate\Contracts\Auth\Authenticatable|mixed|null
     */
    public static function user($id = null)
    {
        // Resolve user from id.
        if ($id) {
            return User::byId($id);
        }

        // Try to resolve user from logged-in user
        if (Auth::check()) {
            return Auth::user();
        }

        // Try to resolve user from bearer
        if ($user = Auth::guard('bearer')->user()) {
            return $user;
        }

        // Try to resolve user from X-Auth-Token
        if ($user = Auth::guard('x-auth')->user()) {
            return $user;
        }

        // By default, return guest user
        return User::guestInstance();
    }

    /**
     * Get cached module list
     *
     * @return Collection<Module>
     */
    public static function modules()
    {
        return \Cache::remember('active-modules', timer('long'), function () {
            return Schema::hasTable('modules') ? Module::getActiveList() : [];
        });
    }

    /**
     * Get cached module groups
     *
     * @return Collection<ModuleGroup>
     */
    public static function moduleGroups()
    {
        return \Cache::remember('active-module-groups', timer('long'), function () {
            return Schema::hasTable('module_groups') ? ModuleGroup::getActiveList() : [];
        });
    }

    /**
     * Create a unique signature/key for an HTTP request made
     * Usually used for caching.
     *
     * @param  string|null  $append  Raw Query string
     */
    public static function httpRequestSignature(?string $append = null)
    {
        $signature = json_encode(Arr::dot(request()->all())); // Take all request params

        if (user()) { // Concat User UUID
            $signature .= '.'.user()->uuid;
        }

        return $signature.'.'.$append; // Append any additional string
    }

    /*
    |--------------------------------------------------------------------------
    | Database/Table/Schema/ related helper functions
    |--------------------------------------------------------------------------
    |
    | Often we shall need to fetch the columns of an existing table. The
    | default Schema::functions do not cache these results, which is
    | not performance-friendly. Here we have a list of similar
    | functions where have cached the values.
    */

    /**
     * Get columns of a table.
     *
     * @param  null  $cache
     * @return array
     */
    public static function tableColumns($table, $cache = null)
    {
        $cache = $cache ?: timer('very-long');

        return \Cache::remember("columns-of-$table", $cache, function () use ($table) {
            return Schema::getColumnListing($table);
        });
    }

    /**
     * Check if a table has the given column
     *
     * @param  null  $cache
     * @return bool
     */
    public static function tableHasColumn($table, $column, $cache = null)
    {
        $cache = $cache ?: timer('very-long');

        return in_array($column, Mf::tableColumns($table, $cache));
    }

    /**
     * Check if the given table has a tenant field (tenant_id)
     *
     * @return bool
     */
    public static function tableHasTenant($table)
    {
        return Mf::tableHasColumn($table, 'tenant_id');
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public static function content(string $key, string $part = 'body')
    {
        $content = Content::where('key', $key)->where('is_active', 1)->first();

        return $content?->part($part);
    }

    /**
     * Create a URL by adding the given params to a URL
     * Ref: https://www.php.net/manual/en/function.parse-url.php
     * https://www.php.net/manual/en/function.parse-str.php
     *
     * @param  string  $url  The URL to add params to
     * @param  array|string|null  $params  The params to add to the URL
     * @return string The modified URL
     */
    public static function link($url, $params = null)
    {
        $url = trim($url, '&?=');
        $base = preg_replace('/\?.*/', '',
            $url); // https://stackoverflow.com/questions/4270677/removing-query-string-in-php-sometimes-based-on-referrer

        $oldQueryStr = parse_url($url,
            PHP_URL_QUERY); // Temporary variable to store the old query string of the given URL

        // Convert old URL query params to array from URL query string
        $oldParams = [];
        if ($oldQueryStr != '') {
            parse_str($oldQueryStr, $oldParams); // Assign the parameter array to $oldParams
        }

        // Convert new params to array
        $newParams = $params ?? [];
        if (! is_array($params)) {
            parse_str($params, $newParams); // Assign the parameter array to $newParams
        }

        $mergedParams = array_merge($oldParams, $newParams);

        $newUrl = $base;
        if (count($mergedParams)) {
            $newUrl .= '?'.http_build_query($mergedParams);
        }

        return trim($newUrl, '&?='); // Trim the URL of any leading or trailing '&' or '?' characters
    }

    /**
     * Cache key for a specific request / url
     * Format url-key-f7fd51329cc3b37990056f286d25157b95a11f09-user:234-{append}
     *
     * @param  string  $append  Additional string to append to the key
     * @return string
     */
    public static function urlKey(string $append = '', array $except = [])
    {
        $segments = [
            'url-key',
            self::urlEncoded($except),
        ];

        $user = user();
        if ($user && $user->id) {
            $segments[] = "user:$user->id";
        }

        if ($append !== '') {
            $segments[] = $append;
        }

        return implode('-', $segments);
    }

    /**
     * Cache key for a specific request / url without user encoded
     */
    public static function statelessUrlKey(string $append = '', array $except = []): string
    {
        $segments = [
            'url-key',
            self::urlEncoded($except),
        ];

        if ($append !== '') {
            $segments[] = $append;
        }

        return implode('-', $segments);
    }

    /**
     * Encode the current request URL into a string that can be used as a key for caching
     */
    public static function urlEncoded(array $except = []): string
    {
        $url = request()->url();
        $queryParams = request()->query();

        ksort($queryParams);
        $queryString = http_build_query(array_excludes($queryParams, $except));

        $fullUrl = "$url?$queryString";

        return sha1($fullUrl);
    }
}
