<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MqttService;
use App\Models\Appliances;
use Illuminate\Support\Facades\DB;

class MqttController extends Controller
{
    public function control_lampu(Request $request, MqttService $mqtt)
    {
        $command = $request->input('command');
        $id = $request->input('id_appliances');

        $device = Appliances::find($id);
        if (!$device || !($device instanceof Appliances)) {
            return redirect()->back()->with('error', 'Perangkat tidak ditemukan.');
        }

        // Publish command ke MQTT
        $mqtt->publish($command);
        return redirect()->back()->with('success', "Perintah \"$command\" berhasil dikirim ke " . ($device->name ?? 'perangkat'));
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

    public function control_auto(Request $request, MqttService $mqtt)
{
    $command = $request->input('command');
    
    if (!in_array($command, ['auto', 'manual'])) {
        return response()->json(['error' => 'Perintah tidak valid'], 400);
    }

    $mqtt->publish($command);
    return response()->json(['success' => true, 'message' => "Perintah \"$command\" berhasil dikirim"]);
}
    }

//                 $app->start_time = null; // Reset start_time