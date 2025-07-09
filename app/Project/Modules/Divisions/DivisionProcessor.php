<?php

namespace App\Project\Modules\Divisions;

use App\Division;
use App\Project\Features\Modular\Validator\ModelProcessor;

class DivisionProcessor extends ModelProcessor
{
    use DivisionProcessorHelper;

    /*
    |--------------------------------------------------------------------------
    | Section - Define properties and variables
    |--------------------------------------------------------------------------
    */
    /** @var Division */
    public $element;
    // public $immutables;
    // public $transitions; // Note: Also you can define in transitions() below
    // public $trackedFields;

    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill model before running rule based validations
     *
     * @param  Division  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate(); 
        return $this;
    }

    /**
     * @param  Division  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:3,100|'.'unique:divisions,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'code' => 'required|digits_between:2,2|'.'unique:divisions,code,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'name_bn' => 'required|between:1,255',
            'latitude' => 'nullable|numeric|between:20.661913,26.635695',
            'longitude' => 'nullable|numeric|between:88.002548,92.675171',
            // 'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /* Further customize error messages and attribute names by overriding */
    public static function customErrorMessages($merge = [])
    {
        $messages = [
            'name_bn.required' => 'The name(Bangla) field is required.',
        ];

        return array_merge($messages, $merge);
    }
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section - Processor Events
    |--------------------------------------------------------------------------
    */

    /**
     * @param  Division  $element
     * @return $this
     */
    public function saving($element)
    {
        // Validate. 
        // If valid, proceed
        if ($this->isValid()) {
            $element->code = pad($element->code, 2);
            $element->combined_code = $element->code;
            $element->setNameExt();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  Division  $element
     * @return $this
     */
    public function saved($element)
    {
        $element->refresh(); // Re-hydrate. Get the updated model(and relations) before using.

        $this->syncDataForChanges(['name', 'code']);

        return $this;
    }

    public function deleting($element)
    {
        $this->checkExistingRelations(['districts']);

        return $this;
    }
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
