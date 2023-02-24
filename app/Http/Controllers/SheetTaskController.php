<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TimeSheet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;
use Response;

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
        $sheets = $user->timesheets;
        // make sheet json has task
        foreach ($sheets as $sheet) {
            $tasks = $sheet->tasks;
            $sheet->tasks = $tasks;
        }
        return view('sheettask', compact('user', 'sheets'));
    }

    //modal binding 
    public function create(Request $request)
    {
        $user = Auth::user();
        $this->authorize('createTimeSheet', TimeSheet::class);
        $sheet = new TimeSheet();
        $sheet->user_id = $user->id;
        $sheet->date = $request->date;
        $sheet->check_in = $request->checkin;
        $sheet->check_out = $request->checkout;
        $sheet->difficult = $request->difficult;
        $sheet->plan = $request->plan;
        $sheet->status = $request->status;
        $sheet->save();
        return redirect()->route('sheettask');
    }

    public function update(Request $request, TimeSheet $sheet)
    {
        $this->authorize('updateTimeSheet', $sheet);
        $sheet->fill($request->all())->save();
        return redirect()->route('sheettask')->with('msg', 'Update success');
    }

    public function delete(Request $request, TimeSheet $sheet)
    {
        $this->authorize('deleteTimeSheet', $sheet);
        $sheet->delete();
        return redirect()->route('sheettask');
    }
    public function updateProfile(Request $request, User $model)
    {
        // $this->authorize('updateProfile', $model);
        $model->fill($request->all())->save();
        return redirect()->route('profile');
    }
}
