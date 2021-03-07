<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['company_name', 'amount'];

    public function group_student() {
        return $this->hasMany('App\GroupStudent', 'company_id', 'id');
    }
}
