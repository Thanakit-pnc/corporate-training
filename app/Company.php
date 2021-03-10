<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['company_name', 'amount', 'expire_date'];

    protected $casts = [
        'expire_date' => 'date',
    ];

    public function company_students() {
        return $this->hasMany(CompanyStudent::class, 'company_id');
    }

    
}
