<?php

namespace App\Project\Modules\MqttMessages\MessageProcessors;

use App\SystemEvent;

class TestMsg extends MessageProcessor
{
    public $isActive = true;

    /**
     * @var \App\MqttMessage
     */
    public $mqttMessage;


    public function process()
    {
        SystemEvent::log(
            name: 'Test message processor',
            details: $this->mqttMessage->body_json,
        );


        return $this;
    }
}


