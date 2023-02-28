<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    use HasFactory;

    protected $table = 'timesheet';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
        'difficult',
        'plan',
        'status',
    ];
    protected $time = [
        'check_in',
        'check_out',
    ];
    public function tasks()
    {
        return $this->hasMany(Task::class, 'sheet_id', 'id');
    }

}
