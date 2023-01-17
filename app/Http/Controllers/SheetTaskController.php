<?php

namespace App\Http\Controllers;

use App\Models\TimeSheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SheetTaskController extends Controller
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
        $month = '1-2023';
        $user = Auth::user();
        $sheet = Timesheet::where('user_id', $user->id)->whereMonth('date', $month)->get();
        // $sheet = Arr::add();
        return view('sheettask', compact('sheet', 'user','month'));
    }
}
