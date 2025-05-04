<?php
// filepath: config/mqtt.php
return [
    'host' => '592a70f5957d46ac89cf5a556a7b811a.s1.eu.hivemq.cloud', // Host HiveMQ Anda
    'port' => 8883, // Port TLS
    'username' => 'itsachar12', // Username HiveMQ Anda
    'password' => 'Itsachar123.', // Password HiveMQ Anda
    'client_id' => 'LaravelClient_' . uniqid(), // ID klien unik
    'topic' => 'esp8266/test', // Topik MQTT
];