<?php

namespace App\Http\Controllers;

use App\Models\TimeSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TimekeepingController extends Controller
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
        $user = Auth::user();
        $sheet = Timesheet::where('user_id', $user->id)->where('date', Carbon::now()->toDateString())->first();
        $check = [
            'check_in' => $sheet?->check_in,
            'check_out' => $sheet?->check_out,
        ];

        return view('timekeeping', compact('check'));
    }

    public function checkin()
    {

        $user = Auth::user();
        $sheet = Timesheet::where('user_id', $user->id)->where('date', Carbon::now()->toDateString())->first();
        if (!$sheet) {
            $sheet = new TimeSheet();
            $sheet->user_id = $user->id;
            $sheet->date = Carbon::now()->toDateString();
        }
        $sheet->check_in = Carbon::now()->toTimeString();
        $sheet->save();
        return redirect()->route('sheettask')->with('success', 'Time in success!');
    }

    public function checkout()
    {
        $user = Auth::user();
        $sheet = Timesheet::where('user_id', $user->id)->where('date', Carbon::now()->toDateString())->first();
        if (!$sheet) {
            $sheet = new TimeSheet();
            $sheet->user_id = $user->id;
            $sheet->date = Carbon::now()->toDateString();
        }
        $sheet->check_out = Carbon::now()->toTimeString();
        $sheet->save();
        return redirect()->route('sheettask')->with('success', 'Time out success!');
    }
}
