<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Appliances;
use Illuminate\Http\Request;

class LightController extends Controller
{
    public function index(Request $request)
    {
        $lightList = Appliances::where('type_appliance', 'Light')->get();

        $selectedLamp = $request->has('id_appliances')
            ? Appliances::find($request->id_appliances)
            : $lightList->first();

        if (!$selectedLamp) {
            return redirect()->route('light')->with('error', 'Lamp not found!');
        }

        $schList = $request->has('id_appliances')
            ? Schedule::where('id_appliances', $request->id_appliances)->get()
            : Schedule::where('id_appliances', $lightList->first()->id_appliances)->get();

        // 🆕 Ambil mode auto/manual dari lampu pertama
        $autoMode = $lightList->first()->mode_control ?? 'manual';

        return view('light', compact('lightList', 'selectedLamp', 'schList', 'autoMode'));
    }

    public function updateMode(Request $request)
    {
        $mode = $request->input('mode'); // nilai: 'auto' atau 'manual'

        // Update semua lampu ke mode yang dipilih
        Appliances::where('type_appliance', 'Light')->update([
            'mode_control' => $mode
        ]);

        return response()->json(['status' => 'success', 'mode' => $mode]);
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