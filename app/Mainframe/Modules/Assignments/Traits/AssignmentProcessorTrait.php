<?php

namespace App\Mainframe\Modules\Assignments\Traits;

use App\Assignment;
use App\Project\Modules\Assignments\AssignmentProcessor;

/** @mixin \App\Mainframe\Modules\Assignments\AssignmentProcessor */
trait AssignmentProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    // /**
    //  * Pre-fill the model before running rule-based validations
    //  *
    //  * @param  Assignment  $element
    //  * @return $this
    //  * @noinspection PhpExpressionResultUnusedInspection
    //  */
    // public function fill($element)
    // {
    //     $element->populate();
    //     return $this;
    // }

    /**
     * @param  Assignment  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'between:1,100|'.'unique:assignments,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'assignee_user_id' => 'required',
            // 'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /* Further customize error messages and attribute names by overriding */
    // public static function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section - Processor Events
    |--------------------------------------------------------------------------
    */

    /**
     * @param  Assignment  $element
     * @return $this
     */
    public function saving($element)
    {
        // First validate

        // Then do further processing
        if ($this->isValid()) {
            $element->setName()->setNameExt();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }

    /**
     * @param  Assignment  $element
     * @return $this|AssignmentProcessor
     */
    public function created($element)
    {
        $element->refresh();
        $element->sendEmail();

        return $this;
    }
    // public function updated($element) { return $this; }
    // public function saved($element) { return $this; }
    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

    /*
    |--------------------------------------------------------------------------
    | Section: Immutables and transitions
    |--------------------------------------------------------------------------
    */
    // /**
    //  * @return array|array[]
    //  */
    // public function transitions() { return $this->transitions; }

    // /**
    //  * @return array|array[]
    //  */
    // public function immutables() { return $this->immutables; }

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
}
