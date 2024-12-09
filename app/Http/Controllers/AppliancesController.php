<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Appliances;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppliancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::all();
        $appliances = Appliances::all();
        $total_act = $appliances->where('status', 'Active');
        $total_ac = $appliances->where('type_appliance', 'AC');
        $total_lamp = $appliances->where('type_appliance', 'Light');
        $total_act_ac = $total_act->where('type_appliance', 'AC');
        $total_act_lamp = $total_act->where('type_appliance', 'Light');
        $total_power = $appliances->sum('electrical_power');
        $total_power_ac = $total_ac->sum('electrical_power');
        $total_power_lamp = $total_lamp->sum('electrical_power');

        return view('appliences', compact('appliances', 'schedules', 'total_act', 'total_ac', 'total_lamp', 'total_act_ac', 'total_act_lamp', 'total_power', 'total_power_ac', 'total_power_lamp' ));
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appliances $appliances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appliances $appliances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appliances $appliances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appliances $appliances)
    {
        //
    }
}
