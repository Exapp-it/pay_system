<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Auth;

class Admin extends Auth
{
    use HasFactory;


    protected $fillable = [
        'username',
        'password',
        'role',
    ];

}
