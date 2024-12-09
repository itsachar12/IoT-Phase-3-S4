<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ACController extends Controller
{
    public function index(Appliances $appliances, Request $request)
    {
        // * daftar ac
        $acList = Appliances::where('type_appliance','AC')->get();
        
        // * Pilian dari daftar ac
        $selectedAc = $request->has('id_appliances') ? Appliances::find($request->id_appliances) 
        : $acList->first();

        // * Jadwall sesuai ac
        $schList = $request->has('id_appliances') 
        ? Schedule::where('id_appliances', $request->id_appliances)->get()
        : Schedule::where('id_appliances', $acList->first()->id_appliances)->get();
        
        return view('ac', compact('acList', 'schList', 'selectedAc'));
    }

    public function status(Request $request, $id){
        $request->validate(
            ['status' =>'required']
        );
        
        $status = Appliances::findOrFail($id);
        $status->status = $request->status;
        $status->save();
        return redirect()->back()->with('sukses', 'Successed');
    }
}
