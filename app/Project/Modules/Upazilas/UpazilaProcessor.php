<?php

namespace App\Project\Modules\Upazilas;

use App\Upazila;
use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Project\Traits\Processor\CheckUniqueCombinedCodeTrait;

class UpazilaProcessor extends ModelProcessor
{
    use UpazilaProcessorHelper, CheckUniqueCombinedCodeTrait;

    /*
    |--------------------------------------------------------------------------
    | Section - Define properties and variables
    |--------------------------------------------------------------------------
    */
    /** @var Upazila */
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
     * @param  Upazila  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate(); 
        return $this;
    }

    /**
     * @param  Upazila  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:1,100',
            'code' => 'required|digits_between:2,2',
            // 'division_id' => 'required',
            'district_id' => 'required',
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
            'district_id.required' => 'The district field is required.',
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
     * @param  Upazila  $element
     * @return $this
     */
    public function saving($element)
    {
        // Todo: First validate
        $element->setCombinedCode();
        $this->checkUniqueCombinedCode();

        // Todo: Then do further processing
        if ($this->isValid()) {
            $element->denormalize();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  Upazila  $element
     * @return $this
     */
    public function saved($element)
    {
        $element->refresh(); // Re-hydrate. Get the updated model(and relations) before using.

        $this->syncDataForChanges(['name', 'code']);

        return $this;
    }
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
