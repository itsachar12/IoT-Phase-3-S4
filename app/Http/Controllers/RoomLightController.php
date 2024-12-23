<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use Illuminate\Http\Request;

class RoomLightController extends Controller
{
    public function index()
    {
        $lightList = Appliances::where('type_appliance', 'Light')->get();
        $total_power = $lightList->sum('electrical_power');



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

        return view('room_light', compact('lightList', 'roomAnalysis', 'total_power'));
    }

    public function updateUsage(Request $request, $id)
    {
        $lampu = Appliances::findOrFail($id);

        $lampu->usage_time = $request->usage_time;
        $lampu->save();
    }
}
