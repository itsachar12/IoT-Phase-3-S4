<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Report;
use App\Models\Summary;
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

    public function showAdd()
    {
        // $timeSpan = Carbon::now()->subDays(0);
        // dd($timeSpan);
        return view('report-add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'type_report' => 'required',
            'description' => 'required',
            'periode' => 'required',
        ]);

        if ($request->periode === 'Today') {
            $timeSpan = 0;
        } else if ($request->periode === 'Week') {
            $timeSpan = 7;
        } else {
            $timeSpan = 30;
        }

        Report::create([
            'type_report' => $request->type_report,
            'description' => $request->description,
            'periode' => $request->periode,
            'date' => date('Y-m-d'),
            'time_span' => Carbon::now()->subDays($timeSpan)

        ]);

        return redirect('report')->with('sukses', 'Sucess Added new report');
    }

    public function view($id)
    {

        $report = Report::find($id);
        $tipe = $report->type_report;
        $periode = $report->periode;
        $report_date = $report->date;
        $format = Carbon::createFromFormat('Y-m-d', $report_date);
        

        $data_summary = Summary::whereHas('appliance', function ($query) use ($tipe) {
            $query->where('type_appliance', $tipe);
        })->get();

        if ($periode === 'Today') {

            
            $data_summary_report = $data_summary->filter(function ($item) use ($report_date) {
                return $item->created_at->isSameDay($report_date);
            });  
            
        } elseif ($periode === 'Week') {
            
            $today = Carbon::now(); 
            $weekStart = Carbon::now()->subDay(7);
            $data_summary_report = $data_summary->filter(function ($item) use ($weekStart, $today) {
                $created_at = Carbon::parse($item->created_at);
                return $created_at->between($weekStart, $today);
            });
            // dd($data_summary_report);
        } elseif ($periode === 'Month') {
            $today = Carbon::now(); 
            $monthStart = Carbon::now()->subDay(30);
            $data_summary_report = $data_summary->filter(function ($item) use ($monthStart, $today) {
                return $item->created_at->between($monthStart, $today);
            });
        }
        return view('see-report', compact('data_summary_report', 'report'));
    }

    public function destroy($id)
    {
        Report::destroy($id);
        return back()->with('sukses', 'Success Deleted Report');
    }
}
