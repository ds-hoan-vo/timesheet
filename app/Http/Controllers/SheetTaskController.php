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
    public $month;
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
        $this->month = Carbon::now()->format('m-Y');
        $user = Auth::user();
        $month = $this->month;
        $sheet = Timesheet::where('user_id', $user->id)->whereMonth('date', $month)->get();
        return view('sheettask', compact('sheet', 'user', 'month'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
       
        $allRequest  = $request->all();
        $sheet = TimeSheet::where('user_id', $user->id)->wheredate('date', $allRequest['date'])->first();
        if (!$sheet) {
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
            $sheet->fill($allRequest)->save();

        return redirect()->route('sheettask');
    }

    // public function show(Timesheet $timesheet)
    // {
    //     $sheet = Timesheet::find($timesheet->id);
    //     $task = Task::where('sheet_id', $sheet->id)->get();
    //     return view('sheettask', compact('sheet', 'task'));
    // }
    // public function store(Timesheet $timesheet, Request $request)
    // {
    //     $allRequest  = $request->all();
    //     $timesheet = TimeSheet::find($timesheet->id);

    //     // foreach ($timesheet as $item) {
    //     //     Task::where('sheet_id', $item->id)->delete();
    //     // }
    //     // Task::create([
    //     //     'content' => $allRequest['content'],
    //     //     'status' => $allRequest['status'],
    //     //     'sheet_id' => $timesheet->id,
    //     // ]);

    //     $timesheet->fill($allRequest)->save();
    //     return redirect()->route('sheettask');
    // }
}
