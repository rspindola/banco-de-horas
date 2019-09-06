<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $schedules = Schedule::where('user_id', auth()->user()->id)->get();

        
        return view('home')->with('schedules', $schedules);
    }
}
