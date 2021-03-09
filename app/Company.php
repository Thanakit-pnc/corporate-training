<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['company_id', 'amount'];

    public function dataset_company() {
        return $this->belongsTo(Dataset_Company::class, 'id');
    }

    public function student_results() {
        return $this->hasMany(StudentResult::class, 'group_id', 'id');
    }
}
