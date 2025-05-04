<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MqttService;

class MqttController extends Controller
{
    public function control(Request $request, MqttService $mqtt)
    {
        $command = $request->input('command');

        if (!in_array($command, ['on', 'off'])) {
            return response()->json(['error' => 'Perintah tidak valid'], 400);
        }

        $mqtt->publish($command);
        return redirect()->back()->with('success', "Perintah \"$command\" berhasil dikirim");

    }
}
//                 $app->start_time = null; // Reset start_time