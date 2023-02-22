<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $table = 'users';
    // protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'username',
        'password',
        'phone',
        'address',
        'avatar',
        'decription',
    ];

    public function timesheets()
    {
        return $this->hasMany(TimeSheet::class, 'user_id', 'id');
    }
}