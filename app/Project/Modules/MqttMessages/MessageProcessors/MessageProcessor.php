<?php

namespace App\Project\Modules\MqttMessages\MessageProcessors;

use App\MqttMessage;
use App\Mainframe\Features\Core\Traits\Validable;

class MessageProcessor
{
    use Validable;

    /**
     * Make this processor active. If turned off this processor will be bypassed
     *
     * @var bool
     */
    public $isActive = true;

    /**
     * @var \App\MqttMessage
     */
    public $mqttMessage;

    /**
     * Constructor
     *
     * @param $mqttMessage
     */
    public function __construct($mqttMessage)
    {
        $this->mqttMessage = $mqttMessage;
    }

    /**
     * Setter for mqttMessage
     *
     * @param  \App\MqttMessage  $mqttMessage
     *
     * @return MessageProcessor
     */
    public function setMqttMessage(MqttMessage $mqttMessage): MessageProcessor
    {
        $this->mqttMessage = $mqttMessage;
        return $this;
    }

    /**
     * Process the message and execute business logic based on the data
     *
     * @return \App\Project\Modules\MqttMessages\MessageProcessors\MessageProcessor
     */
    public function process()
    {
        // Process

        return $this;
    }


}
