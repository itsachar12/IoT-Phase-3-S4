<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use Illuminate\Http\Request;

class LightController extends Controller
{
    public function index()
    {
        $lightList = Appliances::where('type_appliance','Light')->get();
        

        return view('light', compact('lightList'));
    }
}
