<?php

namespace App\Mainframe\Helpers;

use DB;

/**
 * // Note: this is part of the old implementation and needs to be removed.
 * Class Cache
 *
 * @package App\Mainframe\Helpers
 */
class Cache extends \Illuminate\Support\Facades\Cache
{
    /**
     * Get cache time
     *
     * @param  int|string  $key  e.g., 10 minutes, 1 day, 1 week, 1 month, 1 year
     * @return \Illuminate\Config\Repository|int|mixed
     */
    public static function time($key = 0)
    {
        // Request cache refresh
        if (request('no_cache') == 'true') {
            return 0;
        }

        // Query cache disabled in .env
        if (!config('mainframe.config.query_cache')) {
            return 0;
        }

        // A value is forced
        if (is_int($key)) {
            return $key;
        }

        // Check key in config/cache.php
        if (config('cache.times')) {
            return config('cache.times.'.$key, 0);
        }

        // Check key in config/mainframe/cache-time.php
        if (config('mainframe.cache-time')) {
            return config('mainframe.cache-time.'.$key, 0);
        }

        // Parse key to seconds
        if (is_string($key)) {
            return \Carbon\CarbonInterval::make($key)->totalSeconds;
        }


        return 0;
    }

    /**
     * Cache query result
     *
     * @param $query \Illuminate\Database\Query\Builder
     * @param $seconds
     * @return mixed
     */
    public static function query($query, $seconds = 0)
    {
        $key = querySignature($query);

        if ($seconds <= 0) {
            Cache::forget($key);

            return $query->get();
        }

        return \Cache::remember($key, $seconds, function () use ($query) {
            return $query->get();
        });
    }

    /**
     * Caches a raw SQL query for given minutes.
     *
     * @param  string  $sql  Raw SQL statement
     * @param  int  $seconds  Minutes to cache
     * @return array|mixed Array of objects as query result
     */
    public static function rawQuery($sql, $seconds = 0)
    {
        $key = md5($sql);

        if ($seconds <= 0) {
            Cache::forget($key);

            return DB::select(DB::raw($sql));
        }

        return \Cache::remember($key, $seconds, function () use ($sql) {
            return DB::select(DB::raw($sql));
        });
    }
}
