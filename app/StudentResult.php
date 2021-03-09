<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{

    protected $fillable = [
        'group_id', 'student_id', 'text_result', 'score', 'sent_at', 'comment'
    ];

    public $timestamps = false;

    protected $dates = ['sent_at'];

    public function company() {
        return $this->belongsTo(Company::class, 'group_id');
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
