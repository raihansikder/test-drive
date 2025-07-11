<?php

namespace App\Project\Commands;

use App\SystemEvent;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe';

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
        //      mosquitto_sub -h 19019f5980de4a1fa4dc4ae31bb68da7.s1.eu.hivemq.cloud -p 8883 -t "#" -u apollo -P 76_eLV+gmG\MyRK}

        $str= '--';
        $mqtt = MQTT::connection();
        $mqtt->subscribe('test-nodes/+/status', function (string $topic, string $message) {
            $str = sprintf('Received message on topic [%s]: %s', $topic, $message);
            // MQTT::publish('test-xx-nodes/1/status', $str);
            SystemEvent::log('MqttSubscribe', ['details' => $str]);
            echo $str.PHP_EOL;
        });



        $mqtt->loop(true);
        return Command::SUCCESS;
    }
}
