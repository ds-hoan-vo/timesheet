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
        $data['title'] = 'Timekeeping';
        return view('timekeeping', $data);
    }

    public function checkin()
    {
        $sheet = new TimeSheet();
        $sheet->user_id = Auth::user()->id;
        $sheet->check_in = Carbon::now();
        $sheet->save();
        return redirect()->route('sheettask')->with('success', 'Time in success!');
    }
}
