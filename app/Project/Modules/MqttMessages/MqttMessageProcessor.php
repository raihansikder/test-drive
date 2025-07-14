<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Project\Modules\MqttMessages;

use App\MqttMessage;
use App\Project\Features\Modular\Validator\ModelProcessor;

class MqttMessageProcessor extends ModelProcessor
{
    use MqttMessageProcessorHelper;

    /*
    |--------------------------------------------------------------------------
    | Section - Define properties and variables
    |--------------------------------------------------------------------------
    */
    /** @var MqttMessage */
    public $element;

    // public $immutables; // Note- Use immutables() for complex logic
    // public $transitions; // Note- Use transitions() for complex logic
    // public $trackedFields;

    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill the model before running rule-based validations
     *
     * @param  MqttMessage  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate();
        $element->is_processable = 0;
        $element->is_processed = 0;
        return $this;
    }

    /**
     * @param  MqttMessage  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            // 'name' => 'required|between:1,100|'.'unique:mqtt_messages,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'name' => [
                //'required',
                //'between:1,255',
                //Rule::unique('mqtt_messages', 'name')->ignore($element->id)->whereNull('deleted_at'),
            ],
            'topic' => 'required',
            'body' => 'required',
            'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /* Further customize error messages and attribute names by overriding */
    // public static function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section: Processor Events
    |--------------------------------------------------------------------------
    */

    /**
     * @param  MqttMessage  $element
     * @return $this
     */
    public function saving($element)
    {
        // Validate
        $element->fillMetaValues();
        if ($element->hasMessageProcessor()) {
            $element->is_processable = 1;
        }


        // Proceed if valid
        if ($this->isValid()) {
            // $element->setNameExt();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  MqttMessage  $element
     * @return $this
     */
    public function saved($element)
    {
        // Process the payload using message processor in /MessageProcessors folder
        if ($element->shouldProcess() && $element->hasMessageProcessor()) {
            $mqttProc = $element->messageProcessor()->process(); // Resolve processor class and run process

            // Post-processing
            if ($mqttProc->isValid()) {
                $element->is_processed = 1;
                $element->processing_note = 'Processed at '.now();
            } else {
                $element->processing_note = $mqttProc->getErrorsAsSting();
            }

            $element->savequietly();
        }


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
