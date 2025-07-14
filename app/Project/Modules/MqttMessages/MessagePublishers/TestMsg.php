<?php

namespace App\Project\Modules\MqttMessages\MessagePublishers;

use App\User;

class TestMsg extends MessagePublisher
{
    /**
     * @var \App\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    /**
     * Constructor
     *
     * @param  \App\User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Mqtt topic/channel
     *
     * @return string
     */
    public function topic()
    {
        return "test/publish/".$this->user->id;
    }

    /**
     * Mqtt message to publish
     *
     * @return string JSON string
     */
    public function message()
    {
        return json_encode(
            [
                "mqtt_msg_type" => "TestMsg",
                "mqtt_msg_timestamp" => now(),
                "mqtt_msg_source_type" => "Server",
                "mqtt_msg_source_id" => null,
                "user" => [
                    "id" => $this->user->id,
                    "uuid" => $this->user->uuid,
                    "is_active" => $this->user->is_active,
                ],
            ]);
    }
}