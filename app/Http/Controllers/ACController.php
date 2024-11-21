<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ACController extends Controller
{
    public function index()
    {
        // Data dummy untuk halaman
        $acList = [
            [
                'name' => 'AC Room 1',
                'status' => 'Active',
                'power' => '48kWh',
                'color' => 'green',
            ],
            [
                'name' => 'AC Room 2',
                'status' => 'Inactive',
                'power' => '48kWh',
                'color' => 'gray',
            ],
        ];

        $scheduleList = [
            [
                'id' => 1,
                'description' => 'Daily active for lamp 1',
                'time' => '07:00 to 11:00',
                'status' => 'Active',
                'repeat' => 'Daily',
            ],
        ];

        return view('ac', compact('acList', 'scheduleList'));
    }
}
