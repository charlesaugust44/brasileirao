<?php

namespace App\Http\Controllers;

use App\Models\Time;

class DashboardController extends Controller
{
    public function home()
    {
        $times = Time::all();

        return view('home')->with('times', $times);
    }
}
