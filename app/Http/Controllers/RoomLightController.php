<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Summary;
use App\Models\Appliances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomLightController extends Controller
{
    public function index()
    {
        $lightList = Appliances::where('type_appliance', 'Light')->get();
        $total_power = $lightList->sum('total_power');


        $data = Summary::whereHas('appliance', function ($query) {
            $query->where('type_appliance', 'Light');
        });

        $dataForWeek = clone $data;
        $dataForMonth = clone $data;
        

        //! data untuk minggu ini
        $a = $dataForWeek->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_power) as total_power'))
        ->groupBy('date')
        ->pluck('total_power', 'date');

        $dataWeek = array_fill(0, count($a), 0);

        foreach ($a as $i => $totalPower) {
            $dayIndex = Carbon::parse($i)->dayOfWeekIso - 1;
            $dataWeek[$dayIndex] = $totalPower;
        }

        // ! data untuk bulan ini
        $b = $dataForMonth->wherebetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()])
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_power) as total_power'))
        ->groupBy('date')
        ->pluck('total_power', 'date');

        $weeks = [];

        $awalMinggu = Carbon::now()->startOfMonth()->copy();
        while($awalMinggu->lt(Carbon::now())){
            $akhirMinggu = $awalMinggu->copy()->endOfWeek();
            if ($akhirMinggu->gt(Carbon::now())){
                $akhirMinggu = Carbon::now();
            }


            $totalPerWeek = 0 ;
            foreach ($b as $i => $total_power){
                $dataCarbon = Carbon::parse($i);
                if ($dataCarbon->between($awalMinggu, $akhirMinggu)){
                    $totalPerWeek += $total_power;
                }
            }

            $weeks[] = $totalPerWeek;
            
            $awalMinggu = $awalMinggu->addWeek()->startOfWeek();

            
        }
        
        
        $renamedWeeks = [];
        foreach ($weeks as $i => $value){
            $renamedWeeks['Week '. ($i + 1)] = $value;
        }

        


        // Data simulasi untuk Room Analysis
        $roomAnalysis = [
            'today' => Carbon::now()->format('d-m-Y'),
            'week' => $dataWeek,
            'dateStartWeek' => Carbon::now()->startOfWeek()->format('d-m-Y'),
            'dateStartMonth' => Carbon::now()->startOfMonth()->format('d-m-Y'),
            'month' => $renamedWeeks
        ];

        // dd($roomAnalysis['week']['Monday']);

        return view('room_light', compact('lightList', 'roomAnalysis', 'total_power'));
    }

    public function updateUsage(Request $request, $id)
    {
        $request->validate([
            'usage_time' => 'required|integer|min:0',
        ]);
        $lampu = Appliances::findOrFail($id);

        $lampu->usage_time = $request->usage_time;
        // dd($lampu);

        $lampu->save();
        return response()->json(['success' => true, 'message' => 'Usage time updated']);
    }
}
