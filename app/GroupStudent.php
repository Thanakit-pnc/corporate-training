<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{
    protected $table = 'group_student';

    public function companies() {
        return $this->belongsTo('App\Company', 'id', 'company_id');
    }

    public function student() {
        return $this->hasOne('App\Student', 'id', 'student_id');
    }
}
