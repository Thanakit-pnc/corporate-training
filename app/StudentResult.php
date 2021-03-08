<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    protected $fillable = [
        'group_id', 'student_id', 'text_result', 'score', 'sent_at'
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'id');
    }

    public function student() {
        return $this->belongsTo('App\Student');
    }
}
