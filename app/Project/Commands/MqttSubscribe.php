<?php

namespace App\Project\Commands;

use App\MqttMessage;
use PhpMqtt\Client\MqttClient;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe {--topic=#}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe To MQTT topic';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $topic = $this->option('topic');

        $mqtt = MQTT::connection(); // Connect to mqtt broker
        $mqtt->subscribe($topic, function (string $topic, string $message) {
            # Show the message in the console
            $str = sprintf('Received message on topic [%s]: %s', $topic, $message);
            echo $str.PHP_EOL; // Echo in the console. You can use Laravel logger here.

            # Processor handles the data extraction and saving to database
            $proc = new MqttMessage([
                'topic' => $topic,
                'body' => $message,
            ])->processor()->saveAsync();

            if ($proc->isInvalid()) {
                echo $proc->getErrorsAsSting().PHP_EOL; // Echo in the console. You can use Laravel logger here.
            }

            # Testing
            # --------------------------------------------------------------------------------------------
            // Todo: Remove after testing
            // SystemEvent::log(name: 'Job:MqttSubscribe', details: ['topic' => $topic, 'message' => $message]);
            // Publish the receipt on a separate topic and check using MQTT Explorer
            // MQTT::publish('test/received', $message);
            # --------------------------------------------------------------------------------------------
        }, MqttClient::QOS_AT_LEAST_ONCE);

        $mqtt->loop(true); // Loop forever
        return Command::SUCCESS;
    }

}