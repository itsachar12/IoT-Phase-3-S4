<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Models\Appliances;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::all();
        $appliances = Appliances::all();
        return view('add-schedule', compact('schedules', 'appliances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $request->validate([
        'name_appliance' => 'required',
        'time_start' => 'required',
        'time_end' => 'required',
        'repeat_schedule' => 'required',
        'status' => 'required',
    ]);

    // cari ID appliances dari nama
    $id_app = Appliances::where('name', $request['name_appliance'])->first();
    $request['id_appliances'] = $id_app->id_appliances;

    // tambahin tanggal hari ini ke jamnya biar cocok sama format DATETIME
    $today = now()->format('Y-m-d');
    $request['time_start'] = $today . ' ' . $request['time_start'];
    $request['time_end'] = $today . ' ' . $request['time_end'];

    // simpan ke database
    if (Schedule::create($request->all())) {
        return redirect('/appliences')->with('sukses', 'Success added new schedule');
    }

    return back()->with('error', 'Failed to add new schedule!');
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
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule, $id)
    {
        $schedule = Schedule::find($id);
        $dataSch = Schedule::all();
        return view('edit-schedule', compact('schedule', 'dataSch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $sch = Schedule::findOrFail($id);
        $sch->update($request->all());
        return redirect()->back()->with('sukses', 'Success Updated Schedule.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return back()->with('sukses', 'Success Deleted a Schedule ');
    }
}
