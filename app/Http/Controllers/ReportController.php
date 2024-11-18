<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Contoh data dummy
        $reports = [
            [
                'id' => 1,
                'name' => 'Report on the electrical power used by lamp 1',
                'date' => '25 September 2024',
            ],
            [
                'id' => 2,
                'name' => 'Report on the electrical power used by all emitter',
                'date' => '25 Oktober 2024',
            ],
        ];

        // Kirim data ke view
        return view('report', compact('reports'));
    }
}
