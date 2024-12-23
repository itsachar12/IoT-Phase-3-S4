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
        $acList = Appliances::where('type_appliance', 'AC')->get();

        // * Pilian dari daftar ac
        $selectedAc = $request->has('id_appliances') ? Appliances::find($request->id_appliances)
            : $acList->first();

        // * Jadwall sesuai ac
        $schList = $request->has('id_appliances')
            ? Schedule::where('id_appliances', $request->id_appliances)->get()
            : Schedule::where('id_appliances', $acList->first()->id_appliances)->get();

        return view('ac', compact('acList', 'schList', 'selectedAc'));
    }

    public function speed(Request $request, $id)
    {
        $request->validate(
            ['speed_fan' => 'required']
        );

        $ac = Appliances::findOrFail($id);
        $ac->update(['speed_fan' => $request->speed_fan]);
        return redirect()->back();
    }

    public function degree(Request $request, $id)
    {
        $request->validate([
            'degree' => 'required'
        ]);

        $degree = Appliances::findOrFail($id);
        $degree->degree = $request->degree;
        $degree->save();

        return back();
    }

    
}
