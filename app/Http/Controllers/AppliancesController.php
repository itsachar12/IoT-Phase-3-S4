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
        return view('appliences', compact('appliances', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
