<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TimeSheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        $user = Auth::user();
        // $sheet = Timesheet::where('user_id', $user->id)->get();
        
        $sheets = $user->timesheets;
        // dd($sheets);
        return view('sheettask', compact('sheets', 'user'));
    }
    //modal binding 
    public function updatecreate(Request $request)
    {
        $user = Auth::user();
        $allRequest  = $request->all();
        // $sheet = TimeSheet::where('user_id', $user->id)->wheredate('date', $allRequest['date'])->first();
        $sheets = $user->timesheets->where('date', $allRequest['date'])->first();
        if (!$sheets) {
            $sheet = new TimeSheet();
            $sheet->user_id = $user->id;
            $sheet->date = $allRequest['date'];
            $sheet->check_in = $allRequest['checkin'];
            $sheet->check_out = $allRequest['checkout'];
            $sheet->difficult = $allRequest['difficult'];
            $sheet->plan = $allRequest['plan'];
            $sheet->status = $allRequest['status'];
            $sheet->save();
        } else
            $sheets->fill($allRequest)->save();
        return redirect()->route('sheettask');
    }

}
