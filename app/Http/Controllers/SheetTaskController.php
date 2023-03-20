<?php

namespace App\Http\Controllers;

use App\Models\TimeSheet;
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
        $sheet = $user->timesheets()->create($request->all());

        return redirect()->route('sheettask');
    }

    public function update(Request $request, TimeSheet $sheet)
    {
        $this->authorize('updateTimeSheet', $sheet);
        $sheet->tasks->each->delete();
        if ($request->tasks != null) {
            foreach ($request->tasks as $item) {
                $sheet->tasks()->create($item);
            }
        }
        $sheet->fill($request->all())->save();
        return redirect()->route('sheettask')->with('msg', 'Update success');
    }

    public function delete(Request $request, TimeSheet $sheet)
    {
        $this->authorize('deleteTimeSheet', $sheet);
        $sheet->delete();
        return redirect()->route('sheettask')->with('msg', 'Delete success');
    }
}