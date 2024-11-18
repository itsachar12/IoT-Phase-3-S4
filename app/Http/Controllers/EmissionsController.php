<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmissionsController extends Controller
{
    public function index()
    {
        return view('emissions');
    }
}