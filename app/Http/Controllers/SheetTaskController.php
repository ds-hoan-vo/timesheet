<?php

namespace App\Http\Controllers;

use App\Models\TimeSheet;
use Illuminate\Http\Request;
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
        $sheet = DB::table('timesheet');
        $sheet = $sheet->whereMonth('created_at', '01')->get();
        
        $data['title'] = 'Sheettask';
        return view('sheettask', compact($data, $sheet));
    }
}
