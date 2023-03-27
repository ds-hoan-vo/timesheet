<?php

namespace App\Repositories\Timesheet;

use App\Models\TimeSheet;
use App\Repositories\Timesheet\TimeSheetRepositoryInterface;
use Auth;


/**
 * Class TimeSheetRepository.
 */

class TimeSheetRepository implements TimeSheetRepositoryInterface
{
  
    public function all()
    {
        $sheets = Auth::user()->timesheets;
        foreach ($sheets as $sheet) {
            $tasks = $sheet->tasks;
            $sheet->tasks = $tasks;
        }
        return $sheets;
    }
    public function create(array $attributes)
    {
        return Auth::user()->timesheets()->create($attributes);
    }
    public function update($id, array $attributes)
    {
        $sheet = TimeSheet::findOrFail($id);

        $sheet->tasks->each->delete();

        if (isset($attributes['tasks'])) {
            foreach ($attributes['tasks'] as $item) {
                $sheet->tasks()->create($item);
            }
            unset($attributes['tasks']);
        }

        $sheet->fill($attributes)->save();

        return $sheet;

    }
    public function delete($id)
    {
        $sheet = TimeSheet::findOrFail($id);
        $sheet->delete();
    }
}