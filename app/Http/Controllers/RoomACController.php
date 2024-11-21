<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomACController extends Controller
{
    public function index()
    {
        // Data simulasi untuk Appliances
        $appliances = [
            ['name' => 'Panasonic Lamp', 'time' => '3Hour 18Minutes', 'watt' => 23, 'kwh' => 67, 'status' => 'Active'],
            ['name' => 'Panasonic Lamp', 'time' => '3Hour 18Minutes', 'watt' => 23, 'kwh' => 67, 'status' => 'Deactivate'],
            ['name' => 'Panasonic Lamp', 'time' => '3Hour 18Minutes', 'watt' => 23, 'kwh' => 67, 'status' => 'Deactivate'],
        ];

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

        return view('room_ac', compact('appliances', 'roomAnalysis'));
    }
}
