<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use App\Models\Emission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'costIncrease' => 100,
            'predictedUsage' => 200,
        ];

        $ac = Appliances::where('status', 'Active')->where('type_appliance', 'AC')->sum('total_power');
        $light = Appliances::where('status', 'Active')->where('type_appliance', 'Light')->sum('total_power');
        $activeApp = [
            'ac' => $ac,
            'light' => $light,
        ];

        $emission = Emission::all();
        $dataEmission = [
            'total_emision' => $emission->sum('emission'),
            'highestEmision' => $emission->max('predicted_emission'),
            'percentage' => round(($emission->sum('emission') / $emission->max('predicted_emission'))*100)
        ];
        // dd($dataEmisi);
        return view('dashboard', compact('data', 'activeApp', 'dataEmission'));
    }
}
