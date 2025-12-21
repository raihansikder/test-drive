<?php

/** @noinspection PhpUnused */

namespace App\Mainframe\Helpers;

use Carbon\CarbonInterval;
use DB;
use Illuminate\Database\Eloquent\Builder;

/**
 * // Note: this is part of the old implementation and needs to be removed.
 * Class Cache
 */
class Cache extends \Illuminate\Support\Facades\Cache
{
    /**
     * Get cache time(seconds)
     *
     * @param  int|string|null  $key  e.g., 10 minutes, 1 day, 1 week, 1 month, 1 year
     */
    public static function time(int|string|null $key): int
    {
        // Request cache refresh
        if (request('no_cache') == 'true') {
            return 0;
        }

        // Query cache disabled in .env
        if (! config('mainframe.config.query_cache')) {
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

        // Parse key to seconds 10 minutes, 1 day, 1 week, 1 month, 1 year
        if (is_string($key)) {
            return CarbonInterval::make($key)->totalSeconds;
        }

        return 0;
    }

    /**
     * Cache query result
     */
    public static function query(Builder|\Illuminate\Database\Query\Builder $query, int $seconds = 0): mixed
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
    public static function rawQuery(string $sql, int $seconds = 0): mixed
    {
        $key = md5($sql);

        if ($seconds <= 0) {
            Cache::forget($key);

            // return DB::select(DB::raw($sql)); // Old
            return DB::select($sql); // New
        }

        return \Cache::remember($key, $seconds, function () use ($sql) {
            // return DB::select(DB::raw($sql)); // Old
            return DB::select($sql);
        });
    }
}
