<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use Illuminate\Http\Request;

class UsageByRoomController extends Controller
{
    public function index()
    {
        // mengambil data lampu yang
        $lampu = Appliances::where('type_appliance', 'Light')->where('status', 'Active')->get();
        $lamp_power = $lampu->sum('electrical_power');

        //mengambil data ac yangg aktive
        $ac = Appliances::where('type_appliance', 'AC')->where('status', 'Active')->get();
        $ac_power = $ac->sum('electrical_power');
        $ac_degree = $ac_power/$ac->count();
        
        return view('usage_by_room', compact('lamp_power','ac_power', 'ac_degree'));
    }
}
