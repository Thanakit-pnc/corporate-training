<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset_Company extends Model
{
    protected $table = 'dataset_companies';
    protected $fillable = ['company_name'];

    public function companies() {
        return $this->hasMany(Company::class, 'company_id', 'id');
    }
}
