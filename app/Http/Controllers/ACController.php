<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ACController extends Controller
{
    public function index(Appliances $appliances)
    {
        $acList = Appliances::where('type_appliance','AC')->get();
        $schList = Schedule::whereHas('appliance', function ($query) {
            $query->where('type_appliance', 'AC');
        });
        // $schList = Schedule::find(1)->appliance()->where('type_appliance', 'AC')->get();
        // dd($schList);
        return view('ac', compact('acList', 'schList'));
    }
}
