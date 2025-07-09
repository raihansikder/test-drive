<?php

namespace App\Mainframe\Modules\Contents\Traits;

use App\Content;

/** @mixin \App\Content */
trait ContentTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section: Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Accessors
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Mutators
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Attributes
    |--------------------------------------------------------------------------
    */
    /**
     * Get content parts as array key
     *
     * @return array
     */
    public function getPartsArrayAttribute()
    {
        $parts = $this->parts ?? [];

        $array = [];
        foreach ($parts as $part) {
            if (isset($part->key)) {
                $array[$part->key] = $part->value;
            }
        }

        return $array;
    }

    /**
     * Get parts
     *
     * @param $value
     * @return array|mixed
     */
    public function getPartsAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        return json_decode($value ?? '[]');
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Convert key field into kebab case
     *
     * @return $this
     */
    public function sanitizeKey()
    {
        $this->key = $this->key ?: $this->name;

        $this->key = \Str::kebab(strtolower($this->key));
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Autofill functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */

    /**
     * Get content by part key
     *
     * @param  null  $key
     * @return string|null
     */
    public function part($key = null)
    {
        if (!$key || $key == 'body') {
            return $this->mutate(($this->body));
        }

        if ($key == 'title') {
            return $this->mutate(($this->title));
        }

        if (isset($this->parts_array[$key])) {
            return $this->mutate(($this->parts_array[$key]));
        }

        return null;
    }

    /**
     * Mutate the content. Replace keywords with a desired string
     *
     * @param $str
     * @return string
     */
    public function mutate($str)
    {
        $replaces = [
            '{ROOT}' => route('home'),
        ];

        return multipleStrReplace($str, $replaces);
    }

    /**
     * Check if content has a part with given key
     *
     * @param $key
     * @return bool
     */
    public function hasPart($key)
    {
        return (bool) $this->part($key);
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */

    /**
     * Get content by key content key
     *
     * @param $key
     * @param  int  $cache
     * @return Content|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function byKey($key, $cache = 0)
    {
        return Content::where('key', $key)->where('is_active', 1)->remember($cache)->first();
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    // public function isDeletable() { return true; }
    // public function isCloneable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    */

}
