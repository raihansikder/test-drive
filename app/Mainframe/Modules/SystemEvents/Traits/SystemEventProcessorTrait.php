<?php

namespace App\Mainframe\Modules\SystemEvents\Traits;

use App;
use Carbon\Carbon;
use App\SystemEvent;
use App\Mainframe\Helpers\Convert;
use App\Project\Modules\SystemEvents\SystemEventProcessor;

/** @mixin SystemEventProcessor */
trait SystemEventProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill the model before running rule-based validations
     *
     * @param  SystemEvent  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate();
        $element->provider = $element->provider ?? 'SystemEventProvider';
        $element->source = $element->source ?? 'BE';
        $element->environment = $element->environment ?? App::environment();
        $element->type = $element->type ?? 'Event';
        $element->user_id = $element->user_id ?? user()->id;
        $element->occurred_at = $element->occurred_at ?? Carbon::now();

        if (is_array($element->details)) {
            $element->details = json_encode($element->details);
        } elseif (is_object($element->details)) {
            $element->details = serialize($element->details);
        }

        $element->url = $element->url ?? request()->url();
        $element->ip_address = $element->ip_address ?? request()->ip();
        $element->user_agent = $element->user_agent ?? request()->userAgent();
        $element->tags = $element->tags ? Convert::csvToArray($element->tags) : null;
        $element->is_active = 1;

        return $this;
    }

    /**
     * @param  SystemEvent  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            // 'name' => 'required',
            // 'name' => 'required|between:1,100|'.'unique:system_events,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            // // 'is_active' => 'in:1,0',
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
     * @param  SystemEvent  $element
     * @return $this
     */
    public function saving($element)
    {
        // Validate. 
        // If valid, proceed
        if ($this->isValid()) {
            $element->setNameExt();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    // /**
    //  * @param  SystemEvent  $element
    //  * @return $this
    //  */
    // public function saved($element)
    // {
    //     // $element->refresh(); // Re-hydrate. Get the updated model(and relations) before using.
    //
    //     return $this;
    // }

    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

    /*
    |--------------------------------------------------------------------------
    | Section: Immutables and transitions
    |--------------------------------------------------------------------------
    */
    // /**
    //  * Field value transitions
    //  *
    //  * @return array|array[]
    //  */
    // public function transitions() { return $this->transitions; }

    // /**
    //  * Immutable fields
    //  *
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
