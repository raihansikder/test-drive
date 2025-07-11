<?php

namespace App\Mainframe\Modules\SupportTicketCategories\Traits;

use Arr;
use App\SupportTicketCategory;
use Illuminate\Validation\Rule;
use App\Mainframe\Helpers\Convert;

trait SupportTicketCategoryProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill the model before running rule-based validations
     *
     * @param  SupportTicketCategory  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate(); 
        $element->parent_id = $element->parent_id ?? 0;
        $element->order = $element->order ?? 999;

        return $this;
    }

    /**
     * @param  SupportTicketCategory  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {

        $rules = [
            'name' => [
                'required',
                'between:1,255',
                Rule::unique('support_ticket_categories')->where(function ($query) use ($element) {
                    return $query->where('parent_id', $element->parent_id);
                })->ignore($element->id),
            ],

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
     * @param  SupportTicketCategory  $element
     * @return $this
     */
    public function saving($element)
    {
        // Todo: First validate
        $this->checkParent();
        $this->checkValidEmailRecipients();

        // Todo: Then do further processing
        if ($this->isValid()) {
            $element->denormalize()->setNameExt()->setUpperLevelIds()->setLowerLevelIds();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  SupportTicketCategory  $element
     * @return $this
     */
    public function saved($element)
    {
        // $element->refresh(); // Re-hydrate. Get the updated model(and relations) before using.
        SupportTicketCategory::reSyncParentChild();

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

    /**
     * @return $this
     */
    public function checkParent()
    {
        $element = $this->element;

        if ($element->id && $element->parent_id == $element->id) {
            $this->error('Parent is invalid', 'parent_id');
        }

        return $this;
    }

    /**
     * Checks if the email recipients are valid
     *
     * @return $this
     */

    public function checkValidEmailRecipients()
    {
        $element = $this->element;

        if (!$element->email_recipients) {
            return $this;

        }

        $element->email_recipients = Arr::wrap(Convert::csvToArray($element->email_recipients));
        foreach ($element->email_recipients as $emailRecipient) {
            if (filter_var($emailRecipient, FILTER_VALIDATE_EMAIL) == false) {
                $this->error($emailRecipient.' is not a valid email', 'email_recipients');
            }
        }
        $element->email_recipients = array_unique(array_filter($element->email_recipients));

        return $this;
    }
}
