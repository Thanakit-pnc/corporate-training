<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;
    
    public $timestamps = true;
    public $rememberTokenName = false;

    protected $fillable = [
        'name', 'username', 'mobile', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function student_result() {
        return $this->hasOne('App\StudentResult');
    }
}
