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

    public function company_student() {
        return $this->belongsTo(CompanyStudent::class, 'id', 'student_id');
    }
}
