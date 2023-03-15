<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const ADMIN = 'Admin';
    const MANAGER = 'Manager';
    const USER = 'User';
    
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'username',
        'password',
        'phone',
        'address',
        'avatar',
        'decription',
        'role',
    ];

    public function timesheets()
    {
        return $this->hasMany(TimeSheet::class, 'user_id', 'id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user', 'team_id', 'user_id')->withPivot('role');
    }

}