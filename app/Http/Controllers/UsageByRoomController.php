<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsageByRoomController extends Controller
{
    public function index()
    {
        return view('usage_by_room');
    }
}
