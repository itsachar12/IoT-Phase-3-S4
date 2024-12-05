<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Appliances;
use Illuminate\Http\Request;

class LightController extends Controller
{
    public function index(Request $request)
    {
        //* daftar Lampu
        $lightList = Appliances::where('type_appliance', 'Light')->get();

        //* tampil data list lmpu
        $selectedLamp = $request->has('id_appliances') ? Appliances::find($request->id_appliances)
            : $lightList->first();

        // * Jadwall sesuai ac
        $schList = $request->has('id_appliances')
            ? Schedule::where('id_appliances', $request->id_appliances)->get()
            : Schedule::where('id_appliances', $lightList->first()->id_appliances)->get();
        return view('light', compact('lightList', 'selectedLamp', 'schList'));
    }
}
