<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MqttService;
use App\Models\Appliances;

class MqttController extends Controller
{
    public function control(Request $request, MqttService $mqtt)
    {
        $command = $request->input('command');
        $id = $request->input('id_appliances');

        $device = Appliances::find($id);
        if (!$device) {
            return redirect()->back()->with('error', 'Perangkat tidak ditemukan.');
        }

        // Publish command ke MQTT
        $mqtt->publish($command);
        return redirect()->back()->with('success', "Perintah \"$command\" berhasil dikirim ke {$device->name}");
    }

    public function control_kipas(Request $request, MqttService $mqtt)
    {
        $command = $request->input('command');

        if (!in_array($command, ['kipas on', 'kipas off'])) {
            return response()->json(['error' => 'Perintah tidak valid'], 400);
        }

        $mqtt->publish($command);
        return redirect()->back()->with('success', "Perintah \"$command\" berhasil dikirim");

    }
}
//                 $app->start_time = null; // Reset start_time