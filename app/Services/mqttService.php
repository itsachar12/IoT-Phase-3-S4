<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttService
{
    public function publish($message)
    {
        $server   = env('MQTT_HOST');
        $port     = env('MQTT_PORT');
        $username = env('MQTT_USERNAME');
        $password = env('MQTT_PASSWORD');
        $topic    = env('MQTT_TOPIC');
        $clientId = 'laravel-client-' . rand();

        $settings = (new ConnectionSettings)
            ->setUsername($username)
            ->setPassword($password)
            ->setUseTls(true);

        $client = new MqttClient($server, $port, $clientId);
        $client->connect($settings);

        $client->publish($topic, $message, 0);
        $client->disconnect();
    }
}
