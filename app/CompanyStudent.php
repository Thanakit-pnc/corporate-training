<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyStudent extends Model
{
    protected $fillable = ['company_id', 'student_id', 'status', 'sent_at'];

    public $timestamps = false;

    protected $dates = ['sent_at'];

    public function scopeSuccess($query) {
        return $query->where('status', 'success')->get();
    } 
    
    public function student() {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function company() {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function student_results() {
        return $this->hasMany(StudentResult::class, 'comp_std_id');
    }
}
