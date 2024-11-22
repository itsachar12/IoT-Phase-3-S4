<?php

namespace App\Http\Controllers;

use App\Models\Appliances;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppliancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appliances = Appliances::all();
        return view('appliences', compact('appliances'));
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
