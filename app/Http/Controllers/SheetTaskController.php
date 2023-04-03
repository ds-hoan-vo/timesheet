<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeSheet\CreateTimeSheetRequest;
use App\Http\Requests\TimeSheet\UpdateTimeSheetRequest;
use App\Models\TimeSheet;
use App\Repositories\Timesheet\TimeSheetRepositoryInterface ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SheetTaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $timesheetRepository;

    public function __construct(TimeSheetRepositoryInterface  $timesheetRepository)
    {
        $this->middleware('auth');
        $this->timesheetRepository = $timesheetRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $user = Auth::user();
        $sheets = $this->timesheetRepository->all();     

        return view('sheettask', compact('user', 'sheets'));
    }

    //modal binding 
    public function create(CreateTimesheetRequest $request)
    {
        $user = Auth::user();
        $this->authorize('createTimeSheet', TimeSheet::class);
        $sheet = $this->timesheetRepository->create($request->all());

        return redirect()->route('sheettask');
    }

    public function update(UpdateTimeSheetRequest $request, TimeSheet $sheet)
    {
        $this->authorize('updateTimeSheet', $sheet);
        $updatedSheet = $this->timesheetRepository->update($sheet->id, $request->all());

        return redirect()->route('sheettask')->with('msg', 'Update success');
    }

    public function delete(Request $request, TimeSheet $sheet)
    {
        $this->authorize('deleteTimeSheet', $sheet);
        $this->timesheetRepository->delete($sheet->id);
        
        return redirect()->route('sheettask')->with('msg', 'Delete success');
    }
}
