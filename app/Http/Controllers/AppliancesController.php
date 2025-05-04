<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appliances;
use App\Services\MqttService;

class AppliancesController extends Controller
{

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
        $total_power_ac = $total_ac->sum('total_power');
        $total_power_lamp = $total_lamp->sum('total_power');

        
        return view('appliences', compact('appliances', 'schedules', 'total_act', 'total_ac', 'total_lamp', 'total_act_ac', 'total_act_lamp', 'total_power', 'total_power_ac', 'total_power_lamp' ));

    }

    public function status(Request $request, $id){
        $request->validate(
            ['status' =>'required']
        );
        
        $status = Appliances::findOrFail($id);
        $status->update([
            'status' => $request->status,
            'start_time' => Carbon::now(),
            'lux' => $request->status === 'Inactive' ? 0 : rand(1, 100)
        ]);

        return redirect()->back();
    }


    public function resetDataApp(){

        $appliances = Appliances::all();   
        $today = Carbon::now()->format('Y-m-d');

        // pengecekan tnggal hari ini
        foreach ($appliances as $app) {
            $start_time = Carbon::parse($app->start_time)->format('Y-m-d');

            if ($start_time !== $today) {
                $app->total_power = 0;
                $app->usage_time = 0;
                $app->start_time = Carbon::now()->startOfDay();
                $app->save();
            }
        }
        return response()->json(['message' => 'Data has been reset successfully.']);
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
