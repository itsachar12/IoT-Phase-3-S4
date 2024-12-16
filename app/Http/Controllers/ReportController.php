<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Contoh data dummy
        $reports = Report::all();

        // Kirim data ke view
        return view('report', compact('reports'));
    }

    public function showAdd(){
        // $timeSpan = Carbon::now()->subDays(0);
        // dd($timeSpan);
        return view('report-add');
    }

    public function create(Request $request){
        $request->validate([
            'type_report' => 'required',
            'description' => 'required',
            'periode' => 'required',
        ]);

        if($request->periode === 'Today'){
            $timeSpan = 0;
        } else if ($request->periode === 'Week'){
            $timeSpan = 7;
        } else {
            $timeSpan = 30;
        }

        Report::create([
            'type_report' => $request->type_report,
            'description' => $request->description,
            'periode' => $request->periode,
            'date'=> date('Y-m-d'),
            'time_span' => Carbon::now()->subDays($timeSpan)

        ]);

        return redirect('report')->with('sukses', 'Sucess Added new report');
    }


    public function destroy($id){
        Report::destroy($id);
        return back()->with('sukses', 'Success Deleted Report');
    }
}
