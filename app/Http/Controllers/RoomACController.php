<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use Illuminate\Http\Request;

class RoomACController extends Controller
{
    public function index()
    {
        // Data simulasi untuk Appliances
        $acList = Appliances::where('type_appliance', 'AC')->get();
        $total_power = $acList->sum('electrical_power');

        // Data simulasi untuk Room Analysis
        $roomAnalysis = [
            ['day' => 'Mon', 'value' => 3.847, 'color' => 'green'],
            ['day' => 'Tue', 'value' => 22.125, 'color' => 'red'],
            ['day' => 'Wed', 'value' => 15.124, 'color' => 'orange'],
            ['day' => 'Thu', 'value' => 9.245, 'color' => 'blue'],
            ['day' => 'Fri', 'value' => 19.451, 'color' => 'orange'],
            ['day' => 'Sat', 'value' => 5.128, 'color' => 'green'],
            ['day' => 'Sun', 'value' => 10.222, 'color' => 'blue'],
        ];

        return view('room_ac', compact('acList', 'total_power', 'roomAnalysis'));
    }

    public function updateUsage(Request $request, $id)
    {
        $ac = Appliances::findOrFail($id);

        $ac->usage_time = $request->usage_time;
        $ac->save();
    }
}
