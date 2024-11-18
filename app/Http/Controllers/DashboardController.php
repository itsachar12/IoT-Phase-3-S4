<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'costIncrease' => 100,
            'predictedUsage' => 200,
        ];
        
        return view('dashboard', compact('data'));
    }
}
