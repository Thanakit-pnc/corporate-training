<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    protected $guarded = [];

    public $timestamps = true;

    public function scopeTask1($query) {
        return $query->where('task', 1)->first();
    }

    public function scopeTask2($query) {
        return $query->where('task', 2)->first();
    }

    public function scopeOverAll($query) {

        $score =  $query->whereNotNull('score')->sum('score') / 2;
        $floor =  floor($query->whereNotNull('score')->sum('score') / 2);

        $decimal = $score - $floor;

        if($decimal > 0.5) {
            $over_all =  ceil($query->whereNotNull('score')->sum('score') / 2);
        } else {
            $over_all = $score;
        }

        return $over_all;
    }  
}
