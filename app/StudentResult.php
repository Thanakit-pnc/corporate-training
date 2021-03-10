<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    protected $fillable = ['comp_std_id', 'task', 'body', 'score', 'comment'];

    public $timestamps = true;
}
