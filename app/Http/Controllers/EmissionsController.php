<?php

namespace App\Http\Controllers;

use App\Models\Emission;
use Illuminate\Http\Request;

class EmissionsController extends Controller
{
    public function index()
    {
        $emissions = Emission::all();
        // dd($emissions);
        return view('emissions', compact('emissions'));
    }
}