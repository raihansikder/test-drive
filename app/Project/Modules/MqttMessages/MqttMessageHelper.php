<?php

namespace App\Project\Modules\MqttMessages;

use PhpMqtt\Client\Facades\MQTT;

/** @mixin MqttMessage */
trait MqttMessageHelper
{
    /*
    |--------------------------------------------------------------------------
    | Section: Autofill functions 
    |--------------------------------------------------------------------------
    */

    // /**
    //  * Populate model
    //  * return $this
    //  */
    // public function populate() { return $this; }

    /**
     * Extract meta-data from json payload and fill the model's attributes.
     *
     * @return $this
     */
    public function fillMetaValues()
    {
        if ($this->hasJsonPayload()) {
            $this->type = $this->body_json->mqtt_message_type ?? null;
            $this->device_id = $this->body_json->device_id ?? null;
            $this->device_uid = $this->body_json->device_uid ?? null;
        }

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */

    /**
     * Check if message should be processed
     *
     * @return bool
     */
    public function shouldProcess()
    {
        return !$this->is_processed && $this->is_processable;
    }

    /**
     * Check if message has json payload
     *
     * @return bool
     */
    public function hasJsonPayload()
    {
        return (bool) $this->body_json;
    }

    /**
     * Check if a specific expected meta-data is available. If no key is provided,
     * check if all the expected meta-data is available.
     *
     * @param  null  $key
     * @return bool
     */
    public function hasMetaData($key = null)
    {
        if (!$this->hasJsonPayload()) {
            return false;
        }

        // If a key is provided, check if the key exists in the json payload
        if ($key) {
            return isset($this->body_json->{$key});
        }

        // Check if all the expected meta-data is available
        $metaKeys = [
            'mqtt_msg_type',
            'mqtt_msg_timestamp',
            'device_id',
            'device_uid',
        ];

        if (array_any($metaKeys, fn($key) => !isset($this->body_json->{$key}) && empty($this->body_json->{$key}))) {
            return false;
        }

        return true;
    }

    /**
     * Extract type from meta-data
     *
     * @return string|null
     */
    public function extractTypeFromMedaData()
    {
        if (!$this->hasMetaData('mqtt_msg_type')) {
            return;
        }

        return $this->body_json->mqtt_msg_type;
    }

    /**
     * Resolve the message processor class
     *
     * @return string|void
     */
    public function resolveProcessorClass()
    {
        if (!$type = $this->extractTypeFromMedaData()) {
            return;
        }

        // Check if the class exists
        $class = "\App\Project\Modules\MqttMessages\MessageProcessors\\".$type;
        if (!class_exists($class)) {
            return;
        }

        return $class;
    }

    /**
     * Instantiate the message processor
     *
     * @return \App\Project\Modules\MqttMessages\MessageProcessors\MessageProcessor|mixed|void
     */
    public function messageProcessor()
    {
        // Resolve class
        if (!$class = $this->resolveProcessorClass()) {
            return;
        }

        /** @var \App\Project\Modules\MqttMessages\MessageProcessors\MessageProcessor $processor */
        $processor = new $class($this);

        // Check if the processor is active
        if (!$processor->isActive) {
            return;
        }

        return $processor;
    }

    /**
     * Check if a message processor is available
     *
     * @return bool
     */
    public function hasMessageProcessor()
    {
        return (bool) $this->messageProcessor();
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */


    /**
     * Publish a message to a topic
     *
     * @param  string  $topic
     * @param  string  $message
     * @param  bool  $retain
     * @param  null  $connection
     * @return true
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \PhpMqtt\Client\Exceptions\ConfigurationInvalidException
     * @throws \PhpMqtt\Client\Exceptions\ConnectingToBrokerFailedException
     * @throws \PhpMqtt\Client\Exceptions\ConnectionNotAvailableException
     * @throws \PhpMqtt\Client\Exceptions\DataTransferException
     * @throws \PhpMqtt\Client\Exceptions\ProtocolNotSupportedException
     * @throws \PhpMqtt\Client\Exceptions\RepositoryException
     */
    public static function publish($topic, $message, $retain = false, $connection = null)
    {
        MQTT::publish(
            topic: $topic,
            message: $message,
            retain: $retain,
            connection: $connection
        );

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    // public function isDeletable() { return true; }
    // public function isCloneable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    */

}
