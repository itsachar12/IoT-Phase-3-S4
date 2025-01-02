<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Summary;
use App\Models\Appliances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomACController extends Controller
{
    public function index()
    {
        // Data simulasi untuk Appliances
        $acList = Appliances::where('type_appliance', 'AC')->get();
        $total_power = $acList->sum('electrical_power');

        $data = Summary::whereHas('appliance', function ($query) {
            $query->where('type_appliance', 'AC');
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

        return view('room_ac', compact('acList', 'total_power', 'roomAnalysis'));
    }

    public function updateUsage(Request $request, $id)
    {
        $ac = Appliances::findOrFail($id);

        $ac->usage_time = $request->usage_time;
        $ac->save();
    }
}
