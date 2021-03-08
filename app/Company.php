<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['company_id', 'amount'];

    public function dataset_company() {
        return $this->hasOne('App\Dataset_company', 'id', 'company_id');
    }

    public function student_results() {
        return $this->hasMany('App\StudentResult', 'group_id', 'id');
    }
}
