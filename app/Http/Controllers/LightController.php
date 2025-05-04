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

    //* tampil data list lampu
    $selectedLamp = $request->has('id_appliances') 
        ? Appliances::find($request->id_appliances) 
        : $lightList->first();

    // Jika selectedLamp kosong, pastikan ada fallback atau redirect
    if (!$selectedLamp) {
        return redirect()->route('light')->with('error', 'Lamp not found!');
    }
    
    //* Jadwal sesuai ac
    $schList = $request->has('id_appliances')
        ? Schedule::where('id_appliances', $request->id_appliances)->get()
        : Schedule::where('id_appliances', $lightList->first()->id_appliances)->get();

    return view('light', compact('lightList', 'selectedLamp', 'schList'));
}


    public function lux(Request $request, $id)
    {
        $request->validate(['lux' => 'required|min:0|max:100']);


        $lux = Appliances::findOrFail($id);
        $status = $request->lux == 0 ? 'Inactive' : 'Active';

        $lux->update([
            'lux' => $request->lux,
            'status' => $status,
        ]);

        return redirect()->back();
    }
}