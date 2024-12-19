<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'costIncrease' => 100,
            'predictedUsage' => 200,
        ];

        $ac = Appliances::where('status', 'Active')->where('type_appliance', 'AC')->sum('electrical_power');
        $light = Appliances::where('status', 'Active')->where('type_appliance', 'Light')->sum('electrical_power');
        $activeApp = [
            'ac' => $ac,
            'light' => $light,
        ];
        // dd($activeApp);
        return view('dashboard', compact('data', 'activeApp'));
    }
}
