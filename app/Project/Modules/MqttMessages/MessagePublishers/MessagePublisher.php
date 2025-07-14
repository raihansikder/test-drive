<?php

namespace App\Project\Modules\MqttMessages\MessagePublishers;

use App\MqttMessage;

class MessagePublisher
{

    /** @var string */
    public $topic;

    /** @var string */
    public $message;


    /**
     * Mqtt topic/channel
     *
     * @return string
     */
    public function topic()
    {
        return $this->topic;
    }

    /**
     * Mqtt message to publish
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * Publish the mqtt message
     *
     * @return void
     */
    public function publish()
    {
        MqttMessage::publish(
            topic: $this->topic(),
            message: $this->message(),
        );
    }


    /**
     * Set the topic
     *
     * @param  mixed  $topic
     * @return \App\Project\Modules\MqttMessages\MessagePublishers\MessagePublisher
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Set the message
     *
     * @param  mixed  $message
     * @return \App\Project\Modules\MqttMessages\MessagePublishers\MessagePublisher
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }


}
