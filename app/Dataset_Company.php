<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset_Company extends Model
{
    protected $table = 'dataset_companies';
    protected $fillable = ['company_name'];
}
