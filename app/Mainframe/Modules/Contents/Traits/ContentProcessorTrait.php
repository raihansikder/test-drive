<?php

namespace App\Mainframe\Modules\Contents\Traits;

use App\Content;

/** @mixin \App\Mainframe\Modules\Contents\ContentProcessor */
trait ContentProcessorTrait
{
    // public $immutables;
    // public $transitions;
    // public $trackedFields;

    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill the model before running rule-based validations
     *
     * @param  Content  $element
     * @return $this
     */
    public function fill($element)
    {
        $element->key = $element->key ?: $element->name;
        return $this;
    }

    /**
     * @param  Content  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:1,100|'.'unique:contents,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'key' => 'required|between:1,100|'.'unique:contents,key,'.($element->id ?? 'null').',id,deleted_at,NULL',
            // 'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /* Further customize error messages and attribute names by overriding */
    // public function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section - Processor Events
    |--------------------------------------------------------------------------
    */

    /**
     * @param  Content  $element
     * @return $this
     */
    public function saving($element)
    {
        $this->checkPartName();
        if ($this->isValid()) {
            $element->sanitizeKey();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }
    // public function saved($element) { return $this; }
    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

    /*
    |--------------------------------------------------------------------------
    | Section: Functions for deriving immutables & allowed transitions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Other helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Validation helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Functions for deriving immutables & allowed transitions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Other helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Validation helper functions
    |--------------------------------------------------------------------------
    */

    /**
     * Check if part name has invalid key
     *
     * @return $this
     */
    public function checkPartName()
    {
        $element = $this->element;

        $invalids = ['title', 'body', 'name'];
        foreach ($invalids as $part) {
            if (array_key_exists($part, $element->parts_array)) {
                $this->error("'{$part}' can not be used as a part name");
            }
        }

        return $this;
    }

}
