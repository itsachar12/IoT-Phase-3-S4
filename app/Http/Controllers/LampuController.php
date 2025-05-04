<?php
// filepath: app/Http/Controllers/LampuController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MqttService;

class LampuController extends Controller
{
    protected $mqttService;

    public function __construct(MqttService $mqttService)
    {
        $this->mqttService = $mqttService;
    }

    public function control(Request $request)
    {
        $command = $request->input('command');
        if (!in_array($command, ['on', 'off'])) {
            return response()->json(['error' => 'Perintah tidak valid'], 400);
        }

        try {
            $this->mqttService->connect();
            $this->mqttService->publish(config('mqtt.topic'), $command);
            $this->mqttService->disconnect();

            return response()->json(['message' => "Lampu $command"]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}