<?php

namespace App\Repositories\Timesheet;

//use Your Model

/**
 * Class TimeSheetRepositoryInterface.
 */
interface TimeSheetRepositoryInterface{
    public function all();
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}
