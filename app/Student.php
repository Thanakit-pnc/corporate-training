<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;
    
    public $timestamps = true;

    protected $fillable = [
        'name', 'username', 'mobile', 'password'
    ];

    protected $hidden = [
        'password'
    ];
}
