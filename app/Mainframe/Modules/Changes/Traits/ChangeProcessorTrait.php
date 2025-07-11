<?php

namespace App\Mainframe\Modules\Changes\Traits;

use App\Mainframe\Modules\Changes\Change;

/** @mixin \App\Mainframe\Modules\Changes\ChangeProcessor $this */
trait ChangeProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill the model before running rule-based validations for save(create/update)
     *
     * @param  Change  $element
     * @return $this
     */
    // public function fill($element)
    // {
    //     $element->populate();
    //
    //     return $this;
    // }

    // /**
    //  * @param  Change  $element
    //  * @param  array  $merge
    //  * @return array
    //  */
    // public static function rules($element, $merge = [])
    // {
    //     $rules = [
    //         // 'name' => 'required|between:1,255|unique:changes,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
    //         // // 'is_active' => 'in:1,0',
    //     ];
    //
    //     return array_merge($rules, $merge);
    // }

    /* Further customize error messages and attribute names by overriding */
    // public function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section - Processor Events
    |--------------------------------------------------------------------------
    */
    // public function saving($element) { return $this; }
    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }
    // public function saved($element) { return $this; }
    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

    /**
     * Get immutable fields
     *
     * @return array
     */
    public function immutables()
    {
        // All field edits are disabled
        return $this->element->tableColumns();
    }

}
