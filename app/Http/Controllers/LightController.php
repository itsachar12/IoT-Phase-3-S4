<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Appliances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LightController extends Controller
{
    public function index(Request $request)
    {
        $lightList = Appliances::where('type_appliance', 'Light')->get();
        $selectedLamp = $request->has('id_appliances')
            ? Appliances::find($request->id_appliances)
            : $lightList->first();

        if (!$selectedLamp) {
            return redirect()->route('light')->with('error', 'Lamp not found!');
        }

        $schList = $request->has('id_appliances')
            ? Schedule::where('id_appliances', $request->id_appliances)->get()
            : Schedule::where('id_appliances', $lightList->first()->id_appliances)->get();
        
        $autoMode = $lightList->first()->mode_control === 'auto';

        return view('light', compact('lightList', 'selectedLamp', 'schList', 'autoMode'));
    }

    public function updateMode(Request $request)
    {
        $request->validate([
            'command' => 'required|in:auto,manual'
        ]);

        $command = $request->input('command');
        Log::info("Command received: " . $command);

        try {
            DB::transaction(function() use ($command) {
                $updated = Appliances::where('type_appliance', 'Light')
                                   ->update([
                                       'mode_control' => $command,
                                       'last_updated' => now()
                                   ]);

                if ($updated === 0) {
                    throw new \Exception('No lights found to update');
                }
            });

            Log::info("Light mode updated to: {$command}");

            return response()->json([
                'success' => true,
                'new_mode' => $command,
                'message' => "Mode changed to " . strtoupper($command)
            ]);

        } catch (\Exception $e) {
            Log::error("Error updating mode: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update mode'
            ], 500);
        }
    }
}