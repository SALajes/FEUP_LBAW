<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $primaryKey = ['group_id', 'student_id'];

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
}
