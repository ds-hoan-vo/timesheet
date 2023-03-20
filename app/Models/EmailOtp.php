<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of EmailOtp
 */
class EmailOtp extends Model
{
    use HasFactory;
    protected $table = 'email_otps';
    public $guarded = [];
}