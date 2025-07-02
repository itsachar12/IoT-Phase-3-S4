<?php

namespace App\Http\Controllers;

use App\Models\Emission;
use App\Models\Appliances;
use Illuminate\Http\Request;

class UsageByRoomController extends Controller
{
    public function index()
    {
        // Mengambil data lampu yang aktif
        $lampu = Appliances::where('type_appliance', 'Light')->where('status', 'Active')->get();
        $lamp_power = $lampu->sum('electrical_power');

        // Mengambil data AC yang aktif
        $ac = Appliances::where('type_appliance', 'AC')->where('status', 'Active')->get();
        $ac_power = $ac->sum('degree');

        // Cek agar tidak division by zero
        $ac_count = $ac->count();
        $ac_degree = $ac_count != 0 ? $ac_power / $ac_count : 0;

        // Mengambil data emisi
        $emission = Emission::where('status', 'Active')->get();
        $em_power = $emission->sum('power');
        
        return view('usage_by_room', compact('lamp_power','ac_power', 'ac_degree', 'em_power'));
    }
}
